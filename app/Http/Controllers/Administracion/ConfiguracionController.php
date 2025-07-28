<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Clasificacion;


use Redirect;
class ConfiguracionController extends Controller
{
    
    public function __construct(){
        $this->middleware('administradorlogged');
    }


    public function index()
    {   
        $clas = Clasificacion::orderby('giro','asc')->get();
        return view('administracion.configuraciones.index',['clas'=>$clas]);
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

    


    
}
