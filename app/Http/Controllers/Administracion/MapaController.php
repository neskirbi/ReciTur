<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Negocio;
use App\Models\Clasificacion;

class MapaController extends Controller
{
    
    public function __construct(){
        $this->middleware('administradorlogged');
    }

    public function index(Request $filtros)
    {
        $negocios = Negocio::select('negocio','latitud','longitud','solicitud','clasificacion')->get();
        $negocios2 = Negocio::select('negocio','latitud','longitud','solicitud','clasificacion') 
        ->whereraw("clasificacion like '%".$filtros->clasificacion."%'")       
        ->orderby('solicitud','desc')->orderby('negocio','asc')->paginate(15);
        $clasificaciones = Clasificacion::all();
        return view('administracion.mapas.index',['negocion'=>$negocios,'negocios2'=>$negocios2,'clasificaciones'=>$clasificaciones,'filtros'=>$filtros]);
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
