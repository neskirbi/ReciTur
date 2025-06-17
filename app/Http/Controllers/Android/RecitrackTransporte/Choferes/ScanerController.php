<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Chofer;
use Illuminate\Support\Facades\DB;

class ScanerController extends Controller
{
    function DataCita(Request $request){
        return DB::table('citas')
        ->select('id','obra','material',DB::raw("concat(cantidad,' ',unidades) as cantidad"),'planta')
        ->where('id','=',$request->id)
        ->first();
    }

    function AceptarCita(Request $request){

        
         

        $citat = Cita::select('id','obra','material','matricula',
        DB::raw("concat(cantidad,' ',unidades) as cantidad"),
        DB::raw(" '' as id_empresatransporte"),'planta')
        ->where('id','=',$request->id)
        ->where('confirmacion','=',0)
        ->first();

       

        if(!$citat){
            return json_encode(array('error'=>'Esta cita no esta disponible.'));
        }


        $vehiculo=DB::table('vehiculos')
        ->where('matricula',$citat->matricula)
        ->select('id_empresatransporte')
        ->first();

        $citat->id_empresatransporte=$vehiculo->id_empresatransporte;

        $chofer=Chofer::find($request->id_chofer);
        
        
        if(!$chofer){
            return json_encode(array('error'=>'No se encuentra el chofer.'));
        }
        

        $cita = Cita::find($citat->id);
        $cita->firmachof = $request->firmachof;
        
        $cita->nombrecompleto = $chofer->nombres." ".$chofer->apellidos;
        
        $cita->telefonovehiculo=$chofer->telefono;
        $cita->confirmacion = 3;
        if($cita->save()){
            $chofer->id_empresatransporte=$vehiculo->id_empresatransporte;
            //$chofer->save();
            return ($citat);
        }else{
            return json_encode(array('error'=>'Error al guardar'));
        }
            
    }

   
}
