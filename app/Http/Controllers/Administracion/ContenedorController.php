<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contenedor;

class ContenedorController extends Controller
{
    
    public function __construct(){
        $this->middleware('administradorlogged');
    }

    
    public function index()
    {
        $contenedores = Contenedor::orderby('contenedor','asc')->get();
        return view('administracion.contenedores.index',['contenedores'=>$contenedores]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $cont = new Contenedor();
        $cont->id = GetUuid();
        $cont->contenedor = $request->contenedor;
        $cont->save();

        return redirect('contenedores')->with('success','Datos guardados.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    
    

    

    public function update(Request $request,$id){

        $cont = Contenedor::find($id);
        
        $cont->contenedor = $request->contenedor;
        $cont->save();

        return redirect('contenedores')->with('success','Datos guardados.');

    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cont = Contenedor::find($id);
        
        $cont->delete();

        return redirect('contenedores')->with('error','Datos borrados.');
    }
}
