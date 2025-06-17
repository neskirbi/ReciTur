<?php

namespace App\Http\Controllers\WebApp\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recolector;

use App\Models\EmpresaTransporte;

class RegistroTController extends Controller
{
    function index(){
        $empresas = EmpresaTransporte::orderby('razonsocial')
        ->get(); 
        return view('webapp.transportista.registro.create',['empresas'=>$empresas]);
    }


    public function store(Request $request)
    {
        
        
        if($request->pass!=$request->pass2){
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error las contraseñas no coinciden.']);
        }

        $recolector=Recolector::where('telefono',$request->telefono)->first();
        if($recolector){
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error, El teléfono ya fue registrado anteriormente.']);
        }
        
        
        $recolector=new Recolector();
        $recolector->id=GetUuid();


        
        $recolector->id_etransporte=$request->etransporte;
        $recolector->nombres=$request->nombres;        
        $recolector->apellidos=$request->apellidos;
        $recolector->telefono=$request->telefono;
        $recolector->licencia=$request->licencia;
        $recolector->telefono=$request->telefono;
        $recolector->pass=$request->pass;

        if(!GuardarArchivos($request->inefrente,'/documentos/transportistas/recolectores/inefrente',$recolector->id.'.'. $request->inefrente->getClientOriginalExtension())){
            return Redirect::back()->with('error', 'Error al guardar INE del generador.');
        }

        if(!GuardarArchivos($request->inereverso,'/documentos/transportistas/recolectores/inereverso',$recolector->id.'.'. $request->inereverso->getClientOriginalExtension())){
            return Redirect::back()->with('error', 'Error al guardar INE del generador.');
        }
        
        if($recolector->telefono!=null){
            /*
            $response=EnviarMensaje("+52".$recolector->telefono,'Su numero se ha registrado en reci-trash.mx, para confirmar el registro de su número vaya al siguiente link reci-trash.mx/ConfirmacionChofer/'.$recolector->id.' .');
            if(intval($response)>=400){
                return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error, el numero telefónico no es correcto.']);
            }
                */
        }
       
        if($recolector->save()){
            return view('avisos.aviso',['titulo'=>'Registro correcto.','mensaje'=>'En breve recibirá un mensaje de texto para confirmar su teléfono.']);
        }else{
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Intentelo mas tarde.']);
        }
    }
}
