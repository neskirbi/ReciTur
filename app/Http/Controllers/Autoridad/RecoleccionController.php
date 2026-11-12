<?php

namespace App\Http\Controllers\Autoridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recoleccion;
use App\Models\Negocio;

class RecoleccionController extends Controller
{
    function index(Request $filtros){
        $negocios = Negocio::select('id','negocio')->orderby('negocio','asc')->get(); 
        $neg = Negocio::select('id','negocio')->where('id',$filtros->negocio)->first(); 
        $where = isset($filtros->fecha_ini) ? " negocios.id like '%$filtros->negocio%' and date(recolecciones.created_at) >= '$filtros->fecha_ini' and date(recolecciones.created_at) <= '$filtros->fecha_fin' " : " 1=1 "  ;
        $pag = isset($filtros->fecha_ini) ? 15 : 1000000000;
        $recolecciones=Recoleccion::select('negocios.negocio','negocios.giro','recolecciones.id','recolecciones.created_at')
        ->join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->orderby('recolecciones.created_at','desc')
        ->whereraw($where)
        ->paginate($pag);

        return view('autoridad.recolecciones.index',['recolecciones'=>$recolecciones,'negocios'=>$negocios,'neg'=>$neg,'filtros'=>$filtros]);
    }

    function show($id){
        $recoleccion = Recoleccion::select('id',
            DB::RAW("(select recolector from recolectores where id=recolecciones.id_recolector) as responsable")
        )
        ->where('id',$id)->first();
        return view('autoridad.recolecciones.show',['recoleccion'=>$recoleccion]);
    }
}