<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Director;
use App\Models\Administrador;
use App\Models\Finanza;
use App\Models\Planta;
use App\Models\Configuracion;
use Redirect;

class AdministradorController extends Controller
{
    function Administradores($id_municipio){
        
        $administradores=DB::table('administradores')
        ->where('id_municipio',$id_municipio)
        ->orderby('administrador','asc')
        ->get();

        $municipios = DB::table('municipios')
        ->orderby('municipios.municipio','asc')
        ->where('id',$id_municipio)
        ->get();


        
        
        return view('asociados.administradores.index',['administradores'=>$administradores,'municipios'=>$municipios]);
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

        return view('asociados.plantas.planta',['planta'=>$planta,'administradores'=>$administradores]);
    }

    function CreateAdmin(Request $request){
        
        $donde=BuscarCorreo($request->mail);
        if($donde!=''){
            return Redirect::back()->with('error', 'El correo ya esta registrado en '.$donde.', ingresar otro.');
        }
        $admin = new Administrador();
        
        $admin->id=GetUuid();
        $admin->administrador = $request->administrador;
        $admin->id_municipio=$request->id_municipio;
        $admin->mail=$request->mail;
        $admin->pass=$request->pass;
        $admin->save();
        return redirect('administradoresasoc/'.$request->id_municipio)->with('success', 'Se guardaron los datos.');
    }

    function UpdateDirector(Request $request,$id){
        if(isset($request->mail)){
            $donde=BuscarCorreo($request->mail);
            if($donde!=''){
                return Redirect::back()->with('error', 'El correo ya esta registrado en '.$donde.', ingresar otro.');
            }
        }
        $director = Director::find($id);
        $director->director=$request->director;
        $director->mail=isset($request->mail) ? $request->mail : $director->mail;
        $director->pass=$request->pass;
        $director->save();
        return Redirect::back()->with('success', 'Se guardaron los datos.');
    }

    function DeleteDirector($id){
       
        $director = Director::find($id);
        $director->delete();
        return Redirect::back()->with('error', 'Se borraron los datos.');
    }

    function UpdateAdmin(Request $request,$id){
        if(isset($request->mail)){
            $donde=BuscarCorreo($request->mail);
            if($donde!=''){
                return Redirect::back()->with('error', 'El correo ya esta registrado en '.$donde.', ingresar otro.');
            }
        }
        $admin = Administrador::find($id);
        $admin->administrador=$request->administrador;
        $admin->mail=isset($request->mail) ? $request->mail : $admin->mail;
        $admin->pass=$request->pass;
        $admin->save();
        return Redirect::back()->with('success', 'Se guardaron los datos.');
    }

    function DeleteAdmin($id){
       
        $admin = Administrador::find($id);
        $admin->delete();
        return Redirect::back()->with('error', 'Se borraron los datos.');
    }



    function UpdateFinanza(Request $request,$id){
        if(isset($request->mail)){
            $donde=BuscarCorreo($request->mail);
            if($donde!=''){
                return Redirect::back()->with('error', 'El correo ya esta registrado en '.$donde.', ingresar otro.');
            }
        }
        $admin = Finanza::find($id);
        $admin->nombre=$request->nombre;
        $admin->cargo=$request->cargo;
        $admin->mail=isset($request->mail) ? $request->mail : $admin->mail;
        $admin->pass=$request->pass;
        $admin->save();
        return Redirect::back()->with('success', 'Se guardaron los datos.');
    }

    function DeleteFinanza($id){
       
        $admin = Finanza::find($id);
        $admin->delete();
        return Redirect::back()->with('error', 'Se borraron los datos.');
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

    function administradoresasoc(Request $request,$id){
        $admin = Administrador::find($id);
        $admin->administrador=$request->administrador;
        $admin->cargo=$request->cargo;
        $admin->save();
        return Redirect::back()->with('success', 'Se guardaron los datos.');

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
