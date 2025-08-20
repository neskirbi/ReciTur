<?php

namespace App\Http\Controllers\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Residuo;
use App\Models\Negocio;
use App\Models\Recoleccion;
use App\Models\Contenedor;
use App\Models\Recolec;

class RecolectarController extends Controller
{


    public function __construct(){
        $this->middleware('recolectorlogged');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recolectores.recolectar.index');
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


    function HacerRecoleccion($id){
        $residuos = Residuo::orderby('categoria','asc')
        ->orderby('residuo','asc')->get();
        $contenedores = Contenedor::orderby('contenedor','asc')->get();
        $negocio = Negocio::find($id);
        if(count($residuos)!=0){
            return view('recolectores.recolectar.recoleccion',['id'=>$id,'residuos'=>$residuos,'contenedores'=>$contenedores,'negocio'=>$negocio]);
        }else{
            $negocio = Negocio::findOrFail($id);
            $recolectorId = GetId();

            $recoleccion = new Recoleccion();
            $recoleccion->id = GetUuid();
            $recoleccion->id_recolector = $recolectorId; 
            $recoleccion->id_negocio = $negocio->id;
            $recoleccion->save();

    

            $detalle = new Recolec(); 
            $detalle->id = GetUuid();
            $detalle->id_recoleccion = $recoleccion->id;
            $detalle->residuo = "Recolección";
            $detalle->contenedor = "kg";
            $detalle->cantidad = $negocio->estimado;
            $detalle->save();

            return redirect('recoleccionesr')->with('success', 'Recolección guardada correctamente.');

        }
    }

    public function GuardarRecoleccion(Request $request)
{
    // Obtener datos básicos
    $negocio = Negocio::findOrFail($request->input('negocio_id'));
    $residuos = $request->input('residuos', []);
    $recolectorId = GetId(); // o auth()->id()

    // Crear registro principal
    $recoleccion = new Recoleccion();
    $recoleccion->id = GetUuid();
    $recoleccion->id_recolector = $recolectorId; // Nota: cambié a id_recollector
    $recoleccion->id_negocio = $negocio->id;
    $recoleccion->save();

    // Guardar detalles (si es que tienes otra tabla para esto)
    foreach ($residuos as $residuoId => $data) {
        if (isset($data['seleccionado']) && !empty($data['cantidad'])) {
            $residuo = Residuo::find($residuoId);
            if (!$residuo) continue;

            $detalle = new Recolec(); // Asegúrate que este modelo existe
            $detalle->id = GetUuid();
            $detalle->id_recoleccion = $recoleccion->id;
            $detalle->residuo = $residuo->residuo;
            $detalle->contenedor = $data['contenedor'] ?? null;
            $detalle->cantidad = floatval($data['cantidad']);
            $detalle->save();
        }
    }

    return redirect('recoleccionesr')->with('success', 'Recolección guardada correctamente.');
}

}
