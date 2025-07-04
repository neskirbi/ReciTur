<?php

namespace App\Http\Controllers\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Residuo;
use App\Models\Negocio;
use App\Models\Recoleccion;

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
        $negocio = Negocio::find($id);
        return view('recolectores.recolectar.recoleccion',['id'=>$id,'residuos'=>$residuos,'negocio'=>$negocio]);
    }

    public function GuardarRecoleccion(Request $request){
       
        $negocio = Negocio::findOrFail($request->input('negocio_id'));
        $residuos = $request->input('residuos', []);
        
        $recolectorId = GetId(); // o auth()->id()

        foreach ($residuos as $residuoId => $data) {
            if (isset($data['seleccionado']) && floatval($data['cantidad']) > 0) {
                $residuo = Residuo::find($residuoId);
                if (!$residuo) continue;

                $cantidad = floatval($data['cantidad']);
                $subtotal = $cantidad  * $residuo->precio;

            
                $recol = new Recoleccion();
                $recol->id = GetUuid(); // varchar(32)
                $recol->id_recolector = $recolectorId;
                $recol->id_negocio = $negocio->id;
                $recol->residuo = $residuo->residuo; 
                $recol->unidades = $residuo->unidades;
                $recol->cantidad = $cantidad;
                $recol->subtotal = $subtotal;

                $recol->save();
            }
        }

        return redirect('recoleccionesr')->with('success', 'Recolección guardada correctamente.');
    }

}
