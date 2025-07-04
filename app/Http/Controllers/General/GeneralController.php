<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Administrador;
use App\Models\Planta;
use App\Models\Recoleccion;
use App\Models\Configuracion;


class GeneralController extends Controller
{
    function Manifiesto($id){

        $recoleccion=Recoleccion::join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->join('generadores','generadores.id','=','negocios.id_generador')
        ->join('clientes','clientes.id','=','generadores.id_cliente')
        ->where('recolecciones.id',$id)
        ->orderby('recolecciones.created_at','desc')
        ->first();
        

        $planta=Planta::where('id',$recoleccion->id_municipio)->first();
        $configuracion=Configuracion::where('id_municipio',$recoleccion->id_municipio)->first();

        $administrador=Administrador::where('id_municipio',$recoleccion->id_municipio)->where('principal',1)->orderby('created_at','asc')->first();
        //return view('formatos.recolecciones.manifiesto',['recoleccion'=>$recoleccion,'configuracion'=>$configuracion,'planta'=>$planta,'administrador'=>$administrador]);
        $pdf = \PDF::loadView('formatos.recolecciones.manifiesto',['recoleccion'=>$recoleccion,'configuracion'=>$configuracion,'planta'=>$planta,'administrador'=>$administrador]);
        
        return $pdf ->setPaper('A4', 'portrait')->download($recoleccion->negocio.'.pdf');
    }
}
