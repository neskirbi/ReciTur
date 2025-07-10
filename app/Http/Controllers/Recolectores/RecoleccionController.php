<?php

namespace App\Http\Controllers\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recoleccion;
use Redirect;


class RecoleccionController extends Controller
{


    public function __construct(){
        $this->middleware('recolectorlogged');
    }


    
    function index(){
        
        $recolecciones = Recoleccion::select(
            DB::raw('COUNT(id) as recolecciones'),
            DB::raw('DATE(created_at) as fecha')
        )
        ->where('id_recolector', GetId())
        ->groupBy('fecha')
        ->orderBy('fecha', 'desc') // Opcional: ordenar por fecha
        ->paginate(15);
        return view('recolectores.recolecciones.index',['recolecciones'=>$recolecciones]);
    }

    function ManifiestoRecolector($fecha){
        $recolecciones=Recoleccion::select('recolecciones.id','recolecciones.folio','recolecciones.created_at',
        'recolectores.nombres','recolectores.apellidos',
        'negocios.negocio',
        'generadores.id_cliente','generadores.razonsocial','generadores.fisicaomoral','generadores.telefono','generadores.calle','generadores.numeroext','generadores.numeroint','generadores.colonia','generadores.municipio','generadores.cp','generadores.entidad')
        ->leftjoin('recolectores','recolectores.id','=','recolecciones.id_recolector')    
        ->join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->join('generadores','generadores.id','=','negocios.id_generador')
        ->join('clientes','clientes.id','=','generadores.id_cliente')
        ->whereraw("id_recolector = '".GetId()."' and date(recolecciones.created_at) = '".$fecha."'")
        ->orderby('recolecciones.created_at','desc')
        ->get();

        //$recolecciones = Recoleccion::whereraw("id_recolector = '".GetId()."' and date(created_at) = '".$fecha."'")->get();
        $detallesRecoleccion=array();

        foreach($recolecciones as $recoleccion){
            // Obtener los detalles de recolección por separado
            $detallesRecoleccion[] = DB::table('recoleccion')
            ->select('recoleccion.residuo','recoleccion.cantidad','recoleccion.subtotal','recoleccion.unidades')
            ->where('id_recoleccion', $recoleccion->id)
            ->get();
        }
        

        return view('recolectores.recolecciones.manifiesto',['recolecciones'=>$recolecciones,'detallesRecoleccion'=>$detallesRecoleccion]);
        
    }
}
