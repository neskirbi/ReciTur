<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracion;
use App\Models\Administrador;
use App\Models\Planta;
use App\Models\Residuo;
use App\Models\Contenedor;
use App\Models\EmpresaTransporte;


use Redirect;
class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuraciones=DB::table('configuraciones')->where('id_municipio','=',GetIdPlanta())->first();
        $planta=Planta::find(GetIdPlanta());
        $administrador=Administrador::find(GetId());
        $residuos=Residuo::where('id_municipio',GetIdPlanta())->orderby('opcion','asc')->get();
        $empresa=EmpresaTransporte::where('id_transportista',GetIdPlanta())->first();
        if(!$empresa){
            $empresa=new EmpresaTransporte();
        }
        
        $contenedores=Contenedor::where('id_municipio',GetIdPlanta())->orderby('opcion','asc')->get();
        return view('administracion.configuraciones.configuraciones',
        ['configuraciones'=>$configuraciones,'administrador'=>$administrador,
        'planta'=>$planta,'residuos'=>$residuos,'contenedores'=>$contenedores,
        'empresa'=>$empresa
    ]);
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

    public function ConfiguracionBanco(Request $request){
        $configuracion=Configuracion::where('id_municipio','=',GetIdPlanta())->first();
        $configuracion->referencia=$request->referencia;
        $configuracion->banco=$request->banco;
        $configuracion->cuenta=$request->cuenta;
        $configuracion->clabe=$request->clabe;
        $configuracion->iva=$request->iva;
        if($configuracion->save()){
            return redirect('configuracion')->with('success','¡Se guardaron los datos!');
        }else{
            return redirect('configuracion')->with('error','¡Error al guardar!');
        }
    }
    public function ConfiguracionBoleta(Request $request){
        $configuracion=Configuracion::where('id_municipio','=',GetIdPlanta())->first();
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
        $configuracion=Configuracion::where('id_municipio',GetIdPlanta())->first();

       

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


    function Horarios(Request $request,$id){
        if(''==strtotime($request->domingoi) || count(explode(':',$request->domingoi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para domingo invalido.');
        }
        if(''==strtotime($request->lunesi) || count(explode(':',$request->lunesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para lunes invalido.');
        }
        if(''==strtotime($request->martesi) || count(explode(':',$request->martesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para martes invalido.');
        }
        if(''==strtotime($request->miercolesi) || count(explode(':',$request->miercolesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para miercoles invalido.');
        }
        if(''==strtotime($request->juevesi) || count(explode(':',$request->juevesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para jueves invalido.');
        }
        if(''==strtotime($request->viernesi) || count(explode(':',$request->viernesi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para viernes invalido.');
        }
        if(''==strtotime($request->sabadoi) || count(explode(':',$request->sabadoi))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para sabado invalido.');
        }
        if(''==strtotime($request->domingof) || count(explode(':',$request->domingof))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para domingo invalido.');
        }
        if(''==strtotime($request->lunesf) || count(explode(':',$request->lunesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para lunes invalido.');
        }
        if(''==strtotime($request->martesf) || count(explode(':',$request->martesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para martes invalido.');
        }
        if(''==strtotime($request->miercolesf) || count(explode(':',$request->miercolesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para miercoles invalido.');
        }
        if(''==strtotime($request->juevesf) || count(explode(':',$request->juevesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para jueves invalido.');
        }
        if(''==strtotime($request->viernesf) || count(explode(':',$request->viernesf))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para viernes invalido.');
        }
        if(''==strtotime($request->sabadof) || count(explode(':',$request->sabadof))!=2){
            return Redirect::back()->with('error', 'Formato de fecha para sabado invalido.');
        }

        $planta=Planta::find($id);
        $planta->intervalo= $request->intervalo;
        $planta->domingoi= $request->domingoi;
        $planta->lunesi= $request->lunesi;
        $planta->martesi= $request->martesi;
        $planta->miercolesi= $request->miercolesi;
        $planta->juevesi= $request->juevesi;
        $planta->viernesi= $request->viernesi;
        $planta->sabadoi= $request->sabadoi;
        $planta->domingof= $request->domingof;
        $planta->lunesf= $request->lunesf;
        $planta->martesf= $request->martesf;
        $planta->miercolesf= $request->miercolesf;
        $planta->juevesf= $request->juevesf;
        $planta->viernesf= $request->viernesf;
        $planta->sabadof= $request->sabadof;

        if($planta->save()){ 
            return redirect('configuracion')->with('success', 'Datos guardados.');
        }else{
            return redirect('configuracion')->with('error', 'Error al guardar.');
        }
    }


    function Residuo(Request $request){
        //return $request;
        

        $residuo=new Residuo();
        $residuo->id=GetUuid();
        $residuo->id_municipio=GetIdPlanta();
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
        $contenedor->id_municipio=GetIdPlanta();
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
        $configuracion=Configuracion::where('id_municipio','=',GetIdPlanta())->first();
        $planta = Planta::find(GetIdPlanta());

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
        return redirect('configuracion')->with('success','¡Se guardaron los datos!');
        
    }

    function GuardarEmpresaTransporte(Request $request){
        

        $empresa=EmpresaTransporte::where('id_transportista',GetIdPlanta())->first();
        if(!$empresa){
            $empresa=new EmpresaTransporte();
            $id = $empresa->id = GetUuid();
        }

       
        $empresa->id_transportista=GetIdPlanta();
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
            return  Redirect::back();
        }else{
            return Redirect::back();
        }
    }
}
