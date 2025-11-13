<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Negocio;
use App\Models\Clasificacion;

class MapaController extends Controller
{
    
    public function __construct(){
        $this->middleware('inspectorlogged');
    }

    public function index(Request $filtros)
    {
        $negocios = Negocio::select('id','negocio','latitud','longitud','solicitud','clasificacion')        
        ->whereraw("negocio like '%".$filtros->negocio."%'")     
        ->get();
       
        $clasificaciones = Clasificacion::all();
        return view('inspector.mapas.index',['negocios'=>$negocios,'clasificaciones'=>$clasificaciones,'filtros'=>$filtros]);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
