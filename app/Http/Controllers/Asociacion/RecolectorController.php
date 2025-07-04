<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;
use App\Models\Recolector;
use Redirect;


class RecolectorController extends Controller
{
    public function __construct(){
        //$this->middleware('administradorlogged');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recolectores=DB::table('recolectores')
        ->orderby('created_at','asc')
        ->get();

        
        return view('asociados.recolectores.index',['recolectores'=>$recolectores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
        $recolector = Recolector::where('mail','=',$request->mail)->first();
        if($recolector){
            return Redirect::back()->with('error','El correo ya fue registrado anteriormente.');
        }
        
        $recolector=new Recolector();

        $recolector->id=GetUuid();
        $recolector->id_municipio=GetIdMunicipio();        
        $recolector->recolector=$request->nombre;
        $recolector->mail=$request->mail;                        
        $recolector->telefono=$request->telefono;             
        $recolector->pass=$request->pass;

        if($request->telefono!=null){
            //$response=EnviarMensaje("+52".$request->telefono,'Su numero se ha registrado en reci-trash.mx, para confirmar el registro de su número vaya al siguiente link reci-trash.mx/ConfirmacionRecolector/'.$recolector->id.' .');
            /*if(intval($response)>=400){
                return Redirect::back()->with('error','Error, el numero es invalido.');
            }*/
        }


        if($recolector->save()){
            return redirect('recolectores')->with('success','Registro guardado.');
        }else{
            return Redirect::back()->with('error','Error al guardar el registro.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recolector = Recolector::find($id);
        return view('asociados.recolectores.show',['recolector'=>$recolector]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if(isset($request->mail)){
            $recolector = Recolector::where('mail','=',$request->mail)->first();
            if($recolector){
                return Redirect::back()->with('error','El correo ya fue registrado anteriormente.');
            }
        }

        $recolector=Recolector::find($id);
        
        $recolector->nombres=$request->nombres;
        $recolector->apellidos=$request->apellidos;  
        $recolector->licencia=$request->licencia;      


        if($recolector->save()){
            return Redirect::back()->with('success','Registro actualizado.');
        }else{
            return Redirect::back()->with('error','Error al guardar el registro.');
        }
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

    function BorrarRecolector($id){
        $recolector=Recolector::find($id);
        if($recolector->delete()){            
            return redirect('recolectores')->with('error','Registro borrado.');
        }

    }
}
