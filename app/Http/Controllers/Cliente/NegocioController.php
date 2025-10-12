<?php

namespace App\Http\Controllers\Cliente;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Models\Negocio;
use App\Models\Planta;
use App\Models\Entidad;
use App\Models\Generador;
use App\Models\Configuracion;
use App\Models\Clasificacion;
use App\Models\Recoleccion;
use App\Models\Cliente;

use Redirect;


class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('clientelogged');
    }

    public function index()
    {

        $negocios = DB::table('negocios')
        ->join('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('generadores.id_cliente',Auth::guard('clientes')->user()->id)
        ->select('negocios.id','negocios.negocio','negocios.giro','generadores.razonsocial',
        'negocios.verificado','negocios.solicitud')
        ->orderby('negocios.created_at','desc')
        ->get();

        return view('cliente.negocios.index',['negocios'=>$negocios]);
    
    }

    
    public function create(Request $request)
    {
              
        
        $entidades=Entidad::All();
        $generadores=Generador::where('id_cliente','=',Auth::guard('clientes')->user()->id)
        ->where('id',$request->id)
        ->get();

        
        

        $giros = Clasificacion::select('giro')
        ->distinct()
        ->whereNotNull('giro')
        ->orderBy('giro')
        ->get();


        return view('cliente.negocios.create',['generadores'=>$generadores,
        'entidades'=>$entidades,
        'giros'=>$giros]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
       //return $request;
       $id = GetUuid();


       if(isset($request->plan))
        if(!GuardarArchivos($request->plan,'/documentos/negocios/plan/', $id)){
            return Redirect::back()->with('error', 'Error al guardar el plan de menejo.');
        }

        $clasificacion = Clasificacion::WhereRaw("giro = '".$request->giro."' and de <= ".$request->cantidad." and a >= ".$request->cantidad."  ")->first();

        $cla='';
        $uni='';
        if($clasificacion){
            $cla = $clasificacion->clasificacion;
            $uni = $clasificacion->unidades;
        }

        $entidad = Entidad::where('id',$request->entidad)->first();

        $negocio = new Negocio();
        
        $negocio->id = $id;
        $negocio->id_generador = $request->generador;
        $negocio->id_municipio = $request->municipio;
        $negocio->negocio = $request->negocio;
        $negocio->giro = $request->giro;
        $negocio->cantidad = $request->cantidad;
        $negocio->unidades = $uni;
        $negocio->estimado = $request->estimado;
        $negocio->clasificacion = $cla;
        $negocio->calle = $request->calle;
        $negocio->numeroext = $request->numeroext;
        $negocio->numeroint = $request->numeroint=='' ? '' : $request->numeroint ;
        $negocio->colonia = $request->colonia;
        $negocio->cp = $request->cp;
        $negocio->entidad = $entidad->entidad;
        $negocio->municipio = $request->municipio;
        $negocio->latitud = $request->latitud;
        $negocio->longitud = $request->longitud;
        $negocio->contacto = $request->contacto;
        $negocio->correo = $request->correo;
        $negocio->telefono = $request->telefono;
        $negocio->celular = $request->celular;

        $negocio->save();

        return redirect('generadores/'.$request->generador)->with('success', 'Registro correcto.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        
        $negocio=Negocio::find($id);

        $generador=DB::table('generadores')
        ->where('generadores.id',$negocio->id_generador)
        ->first();

        $entidad=DB::table('entidades')
        ->where('id',$negocio->entidad)
        ->first();


        $recolecciones=Recoleccion::select('negocios.negocio','negocios.giro','recolecciones.id','recolecciones.created_at')
        ->join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->orderby('recolecciones.created_at','desc')
        ->where('recolecciones.id_negocio',$id)
        ->get();

        
        return view('cliente.negocios.show',['negocio'=>$negocio,'generador'=>$generador,'entidad'=>$entidad,'recolecciones'=>$recolecciones]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $negocio=Negocio::find($id);
        
        if($negocio->delete()){
            return redirect('negocios')->with('success', 'Se eliminó el registro.');
        }else{
            return redirect('negocios')->with('error', 'Error al eliminar.');
        }
    }


    function Solicitud($id){
        $negocio=Negocio::find($id);

        if($negocio->solicitud){
            $negocio->solicitud = 0;
            $mensaje = 'Se canceló la solicitud de recolección.';
            $satus = 'error';
        }else{
            $negocio->solicitud = 1;
            $mensaje = 'Se solicitó la recolección.';
            $satus = 'warning';
        }
        $negocio->save();
        return Redirect::back()->with($satus, $mensaje);
    }

public function EstadoCuentaMesCliente(Request $request,$id)
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
            ->where('negocios.id',$id)
            ->whereYear('recolecciones.created_at', $request->anio)
            ->whereMonth('recolecciones.created_at', $request->mes)
            ->select(
                'recolecciones.created_at as fecha_recoleccion',
                'negocios.negocio as nombre_negocio',
                'recoleccion.residuo',
                'recoleccion.contenedor',
                'recoleccion.cantidad',
                'recoleccion.precio',
                'recoleccion.multiplicador',
                'recoleccion.unidades'
            )
            ->orderBy('recolecciones.created_at', 'desc')
            ->get();

        if ($recolecciones->isEmpty()) {
            return redirect()->back()->with('info', 'No hay recolecciones para el período seleccionado');
        }

        // Obtener el nombre del negocio y generador
        $nombreNegocio = $recolecciones->first()->nombre_negocio;
        
        // Obtener el nombre del generador
        $generador = Generador::join('negocios', 'negocios.id_generador', '=', 'generadores.id')
            ->where('negocios.id', $id)
            ->value('generadores.razonsocial');

        // Preparar datos para el Excel
        $data = [];
        $totalGeneral = 0;

        foreach ($recolecciones as $recoleccion) {
            $cantidadTotal = $recoleccion->cantidad * $recoleccion->multiplicador;
            $subtotal = $recoleccion->cantidad * $recoleccion->precio * $recoleccion->multiplicador;
            $totalGeneral += $subtotal;

            $data[] = [
                'fecha' => FechaFormateada($recoleccion->fecha_recoleccion),
                'residuos' => $recoleccion->residuo,
                'contenedor' => $recoleccion->contenedor,
                'cantidad_con_unidades' => $cantidadTotal . ' ' . ($recoleccion->unidades ?? ''),
                'precio' => $recoleccion->precio,
                'subtotal' => $subtotal
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

        // Generar Excel usando Export con el generador
        return Excel::download(new \App\Exports\Clientes\EstadoCuentaExport(
            $data, 
            $totalGeneral, 
            $nombreNegocio, 
            $nombreMes, 
            $request->anio,
            $generador
        ), $filename);

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al generar el reporte: ' . $e->getMessage());
    }
}




}
