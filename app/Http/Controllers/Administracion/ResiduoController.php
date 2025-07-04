<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Residuo;

class ResiduoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residuos = Residuo::orderby('categoria','asc')->orderby('residuo','asc')->get();
        return view('administracion.residuos.index',['residuos'=>$residuos]);
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
        $residuo = new Residuo();
        $residuo->id = GetUuid();
        $residuo->categoria = $request->categoria;
        $residuo->residuo = $request->residuo;
        $residuo->precio = $request->precio;
        $residuo->unidades = $request->unidades;
        $residuo->save();
        
        return redirect()->back()->with('success', 'Residuo guardado correctamente.');
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
        // Validar datos
   

        // Buscar el residuo por ID
        $residuo = Residuo::findOrFail($id);

        // Actualizar campos
        $residuo->categoria = $request->input('categoria');
        $residuo->residuo   = $request->input('residuo');
        $residuo->unidades  = $request->input('unidades');
        $residuo->precio    = $request->input('precio');
        $residuo->updated_at = now();

        $residuo->save();

        return redirect()->back()->with('success', 'Residuo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // // Buscar el residuo por ID
        $residuo = Residuo::findOrFail($id);
        $residuo->delete();
        return redirect()->back()->with('error', 'Residuo borrado correctamente.');

    }
}
