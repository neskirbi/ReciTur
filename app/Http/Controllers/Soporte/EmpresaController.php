<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EmpresaTransporte;
use Redirect;


class EmpresaController extends Controller
{
    function index(){
        
        $transportes = DB::table('empresastransporte')
        ->orderby('razonsocial')
        ->paginate(15); 

        return view('soporte.empresas.empresas',['transportes'=>$transportes]);
    }

    function store(Request $request)
    {
        //return $request;
        $empresa=new EmpresaTransporte();
        $id = $empresa->id = GetUuid();
        $empresa->id_transportista='';
        $empresa->razonsocial=$request->razonsocial;
        $empresa->ramir=$request->ramir;
        $empresa->regsct=$request->regsct;
        $empresa->giro=$request->giro;
        $empresa->ramir=$request->ramir;
        $empresa->domicilio=$request->calle.', '.$request->numeroint.', '.$request->numeroext.', Colonia '.$request->colonia.', '.$request->municipio.', Ciudad '.$request->entidad.', C.P.'.$request->cp;
        $empresa->correo=$request->mail;
        $empresa->telefono=$request->telefono;
        $empresa->giro=$request->giro;

        if($empresa->save()){
            return redirect(url('empresassoporte'))->with('success', 'Registro de empresa exitoso');
        }else{
            return Redirect::back();
        }
    }

    function create(){
        return view('soporte.empresas.create');
    }

    function show($id){
        $empresa=EmpresaTransporte::find($id);
        return view('soporte.empresas.editarempresa',['empresa'=>$empresa]);
        

    }

    function update(Request $request,$id){
        $empresa=EmpresaTransporte::find($id);        
        
        $empresa->razonsocial=$request->razonsocial;
        $empresa->ramir=$request->ramir;
        $empresa->regsct=$request->regsct;
        $empresa->giro=$request->giro;
        $empresa->ramir=$request->ramir;
        $empresa->domicilio=$request->domicilio;
        $empresa->correo=$request->mail;
        $empresa->telefono=$request->telefono;
        $empresa->giro=$request->giro;
        if($empresa->save()){
            RevisaDatosVehiculos($request,$id);
            return redirect('empresassoporte/'.$id)->with('success','Registro de empresa exitoso');
        }else{
            return redirect('empresassoporte/'.$id)->with('error','Error al guardar la empresa');
        }
    }

}