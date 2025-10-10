<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use Redirect;

use App\Models\Negocio;
use Maatwebsite\Excel\Facades\Excel;


class RecoleccionController extends Controller
{


    public function __construct(){
        $this->middleware('clientelogged');
    }


    
    function index(){
        $recolecciones=Cliente::join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('negocios','negocios.id_generador','=','generadores.id')
        ->join('recolecciones','recolecciones.id_negocio','=','negocios.id')
        ->where('clientes.id',GetId())
        ->orderby('recolecciones.created_at','desc')
        ->get();
        return view('cliente.recolecciones.index',['recolecciones'=>$recolecciones]);
    }

    public function EstadoCuentaMesCliente(Request $request)
    {
        try {
            // Validar parámetros
            if (!is_numeric($request->anio) || !is_numeric($request->mes) || $request->mes < 1 || $request->mes > 12) {
                return redirect()->back()->with('error', 'Parámetros inválidos');
            }

            // Obtener las recolecciones con las relaciones
            $recolecciones = Cliente::join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
                ->join('negocios', 'negocios.id_generador', '=', 'generadores.id')
                ->join('recolecciones', 'recolecciones.id_negocio', '=', 'negocios.id')
                ->join('recoleccion', 'recoleccion.id_recoleccion', '=', 'recolecciones.id')
                ->where('clientes.id', GetId())
                ->whereYear('recolecciones.created_at', $request->anio)
                ->whereMonth('recolecciones.created_at', $request->mes)
                ->select(
                    'recolecciones.created_at as fecha_recoleccion',
                    'negocios.negocio as nombre_negocio',
                    'recoleccion.residuo',
                    'recoleccion.contenedor',
                    'recoleccion.cantidad',
                    'recoleccion.precio',
                    'recoleccion.multiplicador'
                )
                ->orderBy('recolecciones.created_at', 'desc')
                ->get();

            if ($recolecciones->isEmpty()) {
                return redirect()->back()->with('info', 'No hay recolecciones para el período seleccionado');
            }

            // Obtener el nombre del negocio (tomamos el primero)
            $nombreNegocio = $recolecciones->first()->nombre_negocio;

            // Preparar datos para el Excel
            $data = [];
            $totalGeneral = 0;

            foreach ($recolecciones as $recoleccion) {
                $subtotal = $recoleccion->cantidad * $recoleccion->precio * $recoleccion->multiplicador;
                $totalGeneral += $subtotal;

                $data[] = [
                    'Fecha' => FechaFormateada($recoleccion->fecha_recoleccion),
                    'Negocio' => $recoleccion->nombre_negocio,
                    'Residuo' => $recoleccion->residuo,
                    'Contenedor' => $recoleccion->contenedor,
                    'Cantidad' => $recoleccion->cantidad,
                    'Precio Unitario' => $recoleccion->precio,
                    'Multiplicador' => $recoleccion->multiplicador,
                    'Subtotal' => $subtotal
                ];
            }

            // Nombre del archivo
            $request->meses = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];
            
            $nombreMes = $request->meses[$request->mes];
            $filename = "Estado_Cuenta_{$nombreNegocio}_{$nombreMes}_{$request->anio}.xlsx";

            // Generar Excel usando Export con el namespace correcto
            return Excel::download(new \App\Exports\Clientes\EstadoCuentaExport($data, $totalGeneral, $nombreNegocio, $nombreMes, $request->anio), $filename);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }
}
