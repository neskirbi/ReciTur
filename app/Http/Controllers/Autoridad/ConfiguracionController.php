<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Clasificacion;
use App\Models\Centro;


use Redirect;
class ConfiguracionController extends Controller
{
    
    public function __construct(){
        $this->middleware('administradorlogged');
    }


    public function index()
    {   
        $clas = Clasificacion::orderby('giro','asc')->get();
        $centro =  Centro::where('id_administrador',GetId())->first();

        return view('administracion.configuraciones.index',['clas'=>$clas,'centro'=>$centro]);
    }


    public function store(){

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




    public function GuardarClasificaciones(Request $request){

        $cla = new Clasificacion();

        $cla->id = GetUuid();
        $cla->giro = $request->giro;
        $cla->clasificacion = $request->clasificacion;
        $cla->unidades = $request->unidades;
        $cla->de = $request->de;
        $cla->a = $request->a;

        $cla->save();

        return Redirect::back()->with('success','Datos guardados.');

    }


    public function ActualizarClasificaciones(Request $request,$id){

        $cla =  Clasificacion::find($id);

        
        $cla->giro = $request->giro;
        $cla->clasificacion = $request->clasificacion;
        $cla->unidades = $request->unidades;
        $cla->de = $request->de;
        $cla->a = $request->a;

        $cla->save();

        return Redirect::back()->with('success','Datos guardados.');

    }


    public function EliminarClasificaciones($id){
         $cla =  Clasificacion::find($id);
          $cla->delete();

        return Redirect::back()->with('error','Datos borrados.');

    }

    function GuardarCentro(Request $request){
        $centro = new Centro();

        $centro->id = GetUuid();
        
        $centro->id_administrador = GetId();
        $centro->nombreEmpresa = $request->nombreEmpresa;
        $centro->autorizacionRamir = $request->autorizacionRamir;
        $centro->domicilioFiscal = $request->domicilioFiscal;
        $centro->telefono = $request->telefono;
        $centro->nombreReceptor = $request->nombreReceptor;
        $centro->cargoReceptor = $request->cargoReceptor;
      
        $centro->save();

        return Redirect::back()->with('success','Datos guardados.');
    }

    function ActualizarCentro(Request $request,$id){
        $centro = Centro::find($id);
      
        
        $centro->nombreEmpresa = $request->nombreEmpresa;
        $centro->autorizacionRamir = $request->autorizacionRamir;
        $centro->domicilioFiscal = $request->domicilioFiscal;
        $centro->telefono = $request->telefono;
        $centro->nombreReceptor = $request->nombreReceptor;
        $centro->cargoReceptor = $request->cargoReceptor;
      
        $centro->save();

        return Redirect::back()->with('success','Datos guardados.');
    }

    


    
}
