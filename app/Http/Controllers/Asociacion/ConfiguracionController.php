<?php

namespace App\Http\Controllers\Asociacion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracion;
use App\Models\Administrador;
use App\Models\Planta;
use App\Models\Residuo;
use App\Models\Contenedor;
use Redirect;
class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('asociadoislogged');
    }

    public function show($id)
    {
        $configuracion=DB::table('configuraciones')->where('id_municipio','=',$id)->first();
        $planta=Planta::find($id);
        $residuos=Residuo::where('id_municipio',$id)->orderby('opcion','asc')->get();
        
        $contenedores=Contenedor::where('id_municipio',$id)->orderby('opcion','asc')->get();
        return view('asociados.configuraciones.configuraciones',['configuracion'=>$configuracion,'planta'=>$planta,'residuos'=>$residuos,'contenedores'=>$contenedores]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function GuardarDatosBancoAsoc(Request $request,$id){
        //return $request;
        $configuracion=Configuracion::where('id_municipio','=',$id)->first();
        $configuracion->referencia=$request->referencia;
        $configuracion->banco=$request->banco;
        $configuracion->cuenta=$request->cuenta;
        $configuracion->clabe=$request->clabe;
        $configuracion->iva=$request->iva;
        if($configuracion->save()){
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error','¡Error al guardar!');
        }
    }
    public function ConfiguracionBoleta(Request $request){
        $configuracion=Configuracion::where('id_municipio','=',$id)->first();
        $configuracion->folio=$request->folio;
        if($configuracion->save()){
            return redirect('configuracion')->with('success','¡Se guardaron los datos!');
        }else{
            return redirect('configuracion')->with('error','¡Error al guardar!');
        }
    }

    function ConfiguracionCuenta(Request $request){
        $administrador=Administrador::where('mail',$request->mail)->first();

        if($administrador && $request->mail!=GetMail()){
            return redirect('configuracion')->with('error','Error, el correo ya esta en uso.');
        }

        $administrador=Administrador::find(GetId());
        $administrador->administrador=$request->administrador;
        $administrador->cargo=$request->cargo;
        $administrador->firma=$request->firma==null ? '' : $request->firma;
        if($administrador->save()){            
            return redirect('configuracion')->with('succes', 'Datos guardados.');
        }else{
            return redirect('configuracion')->with('error', 'Error al guardar.');
        }
    }


    function ConfiguracionRepresentante(Request $request){
        $configuracion=Configuracion::where('id_municipio',$id)->first();

       

        //$representante=Configuracion::find(GetId());
        $configuracion->representante=$request->representante;
        $configuracion->mail=$request->mail;
        $configuracion->cargo=$request->cargo;
        $configuracion->firma_repre=$request->firma==null ? '' : $request->firma;
        if($configuracion->save()){            
            return redirect('configuracion')->with('succes', 'Datos guardados.');
        }else{
            return redirect('configuracion')->with('error', 'Error al guardar.');
        }
    }

    

    function CambioPass(Request $request,$id){
        if($request->pass!=$request->pass){            
            return redirect('configuracion')->with('error', 'Error, las contraseñas no coinciden.');
        }
        $administrador=Administrador::find($id);
        $administrador->pass=password_hash($request->pass,PASSWORD_DEFAULT);
        if($administrador->save()){ 
            return redirect('logout');
            return redirect('configuracion')->with('success', 'Datos guardados.');
        }else{
            return redirect('configuracion')->with('error', 'Error al guardar.');
        }
    }


    

    function Residuo(Request $request){
        //return $request;
        

        $residuo=new Residuo();
        $residuo->id=GetUuid();
        $residuo->id_municipio=$id;
        $residuo->residuo=$request->residuo;
        $residuo->precio=$request->precio;
        $residuo->unidades=$request->unidades;
        $residuo->opcion=$request->opcion;
        if($residuo->save()){
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }
    }

    function BorrarResiduo($id){
        $residuo=Residuo::find($id);
        $residuo->delete();
        return Redirect::back()->with('error', 'Se borró del catálogo.');

    }


    
    function Contenedor(Request $request){
        //return $request;
        

        $contenedor=new Contenedor();
        $contenedor->id=GetUuid();
        $contenedor->id_municipio=$id;
        $contenedor->contenedor=$request->contenedor;
        $contenedor->cantidad=$request->cantidad;
        $contenedor->opcion=$request->opcion;
        
        if($contenedor->save()){
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }
    }


    function BorrarContenedor($id){
        $contenedor=Contenedor::find($id);
        $contenedor->delete();
        return Redirect::back()->with('error', 'Se borró del catálogo.');

    }

    function GuardarDatosPlanta(Request $request,$id){
        $configuracion=Configuracion::where('id_municipio','=',$id)->first();
        $planta = Planta::find($id);

        $planta->planta = $request->planta;
        $planta->plantaauto = $request->plantaauto;
        $planta->codigo = $request->codigo;
        $planta->direccion = $request->direccion;
        $planta->save();

        $configuracion->telefono = $request->telefono;
        $configuracion->razonsocial = $request->razonsocial;
        $configuracion->ruta = $request->ruta;
        $configuracion->sct = $request->sct;

        $configuracion->save();
        return Redirect::back()->with('success','¡Se guardaron los datos!');
        
    }
}
