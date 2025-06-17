<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Coordenada;
use App\Models\Cita;

class ViajesController extends Controller
{
    function HistorialViajes(Request $request){
        //return $request;
        //return $request->id_chofer;
        $respuesta=array();
        $request=PostmanAndroid($request);
        
        /*$coordenadas=Coordenada::select('coordenadas.id_cita')
        ->distinct()
        ->where('coordenadas.id_cita','!=','')
        ->where('coordenadas.id_referencia',$request[0]['id_chofer'])
        ->orderby('coordenadas.created_at','desc')->get();*/
        $coordenadas=DB::select(DB::raw("SELECT DISTINCT(id_cita) FROM coordenadas where id_referencia='".$request[0]['id_chofer']."' and id_cita!='' "));
        $array=array();

        $in=array();
        foreach($coordenadas as $coordenada){
            $in[]=$coordenada->id_cita;
        }

        //$in=implode("','",$in);
        $citas=Cita::select('planta','id','cantidad','unidades','material','created_at')->orderby('created_at','desc')->wherein('id',$in)->get();
        foreach($citas as $cita){
            //Lo mando a fecha por que el atributo no acepta el formato que regresa FechaFormateada
            $cita->fecha=FechaFormateadaTiempo($cita->created_at);
            $array[]=$cita;
        }

        return $array;
    }
}
