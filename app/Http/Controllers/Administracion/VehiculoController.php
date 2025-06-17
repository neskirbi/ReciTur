<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Vehiculo;
use App\Models\Transportista;
use App\Models\EmpresaTransporte;

class VehiculoController extends Controller
{
    function index(Request $filtros){ 
        $paginacion=15;
        if($filtros->matricula!=''){
            $paginacion=10000;
        }
        
        $vehiculos=DB::table('vehiculos')
        ->where('id_municipio','=',GetIdMunicipio())        
        ->where('vehiculos.matricula','like','%'.$filtros->matricula.'%')
        ->orderby('matricula','asc')
        ->orderby('vehiculos.created_at','desc')
        ->paginate($paginacion);
        
        return view('administracion.vehiculos.vehiculos',['vehiculos'=>$vehiculos,'filtros'=>$filtros]);
    }

    function create(){
        
       
        return view('administracion.vehiculos.create');
    }

    function store(Request $request){  
        $buscar=Vehiculo::where('matricula',$request->matricula)
        ->first();

        if($buscar){            
            Redirect::back()->with('error', 'Esta matricula ya fue dada de alta.');
        }
        
        

        $vehiculo=new Vehiculo();
        $vehiculo->id = GetUuid();
        $vehiculo->id_municipio = GetIdMunicipio();
        $vehiculo->vehiculo = $request->vehiculo;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->matricula = $request->matricula;
        $vehiculo->combustible = $request->combustible;
        
    
        $vehiculo->detalle = $request->detalle;
        
      

        if($vehiculo->save()){
            return redirect('vehiculos')->with('success','Vehículo registrado correctamente.');
        }else{
            return redirect('vehiculos/create')->with('error','Error al guardar.');
        }
        
        
    }

    function show($id){
        $vehiculo=Vehiculo::find($id);
        return view('administracion.vehiculos.editar',['vehiculo'=>$vehiculo]);
        

    }
    
    function update(Request $request,$id){
        $vehiculo= Vehiculo::find($id);
        
        
        $vehiculo->vehiculo=$request->vehiculo;
        $vehiculo->marca=$request->marca;
        $vehiculo->modelo=$request->modelo;
        $vehiculo->matricula=$request->matricula;
        $vehiculo->combustible=$request->combustible;        
        $vehiculo->detalle=$request->detalle;        
       
       

        if($vehiculo->save()){
            return redirect('vehiculos/'.$id)->with('success','Registro de vehículo exitoso');
        }else{
            return redirect('vehiculos/'.$id)->with('error','Error al guardar la vehículo');
        }
    }
}
