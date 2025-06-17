<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Administrador;
use App\Models\Planta;
use App\Models\Configuracion;
use Redirect;

class MunicipioController extends Controller
{

    public function __construct(){
        $this->middleware('asociadoislogged');
    }
    
    function index(Request $request){
        $paginas = 15;
        if(isset($request->entidad)){
            $paginas = 1000;
        }
        $municipios = DB::table('entidades')
        ->join('municipios','municipios.id_entidad','=','entidades.id')
        ->whereraw("municipio like '%".$request->municipio."%' ")
        ->whereraw("entidad like '%".$request->entidad."%' ")
        ->orderby('entidades.entidad','asc')
        ->orderby('municipios.municipio','asc')
        ->paginate($paginas);
        return view('asociados.municipios.index',['municipios'=>$municipios,'filtros'=>$request]);
    }

    function show($id){
        $planta = DB::table('plantas')
        ->where('id',$id)
        ->first();

        $administradores=DB::table('administradores')
        ->where('id_municipio',$planta->id)
        ->where('principal',1)
        ->orderby('administrador','asc')
        ->get();

        return view('asociados.municipios.planta',['planta'=>$planta,'administradores'=>$administradores]);
    }

    function update(Request $request,$id){
        $planta=Planta::find($id);
        $planta->planta=$request->planta;
        $planta->siglas=$request->siglas;
        $planta->direccion=$request->direccion;
        $planta->codigo=$request->codigo;
        $planta->plantaauto=$request->plantaauto;
        if($planta->save()){
            return redirect('municipios/'.$id)->with('success', 'Se actializ&oacute; la informaci&oacute;n.');
        }else{
            return redirect('municipios/'.$id)->with('error', 'Error al guardar.');
        }
    }

    function PlantaReg(Request $request){
        $administrador=Administrador::where('mail',$request->mail)->first(); 
        if($administrador){            
            return redirect('municipios')->with('error', 'El correo de administrador ya está registrado, debe utilizar otro.');
        }  


        $planta=new Planta();
        $planta->id=GetUuid();
        $planta->planta=$request->planta;
        $planta->siglas=$request->siglas;
        $planta->direccion=$request->direccion;
        $planta->codigo=$request->codigo;
        $planta->plantaauto=$request->plantaauto;
        $planta->tipo=$request->tipo;

        if(!$planta->save()){
            return redirect('municipios')->with('error', 'Error al registrar la planta.');            
        }


        $administrador=new Administrador();
        $administrador->id=GetUuid();
        $administrador->id_municipio=$planta->id;
        $administrador->administrador=$request->administrador;
        $administrador->cargo=$request->cargo;
        $administrador->mail=$request->mail;
        $administrador->principal=1;
        $administrador->pass=password_hash($request->pass,PASSWORD_DEFAULT);
        if(!$administrador->save()){
            return redirect('municipios')->with('error', 'Error al registrar al administrador.');  
        }


        $configuracion=new Configuracion();
        $configuracion->id=GetUuid();
        $configuracion->id_municipio=$planta->id;

        if(!$configuracion->save()){
            return redirect('municipios')->with('error', 'Error la configurar.');  
        }
        
        return redirect('municipios')->with('success', 'La planta se registr&oacute; correctamente.');
    }

    

    function InactivarPlanta($id){
        
        $planta = Planta::find($id);
        $planta->activa = 0;
        $planta->save();
        
        return Redirect::back()->with('error','Planta inactiva.');
    }


    function ActivarPlanta($id){
        
        $planta = Planta::find($id);
        $planta->activa = 1;
        $planta->save();
        
        return Redirect::back()->with('error','Planta inactiva.');
    }
}
