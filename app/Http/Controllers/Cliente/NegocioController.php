<?php

namespace App\Http\Controllers\Cliente;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Negocio;
use App\Models\TipoNegocio;
use App\Models\Planta;
use App\Models\Entidad;
use App\Models\Generador;
use App\Models\Configuracion;

use Redirect;


class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('clientelogged');
    }

    public function index()
    {
        

        $negocios = DB::table('negocios')
        ->join('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('generadores.id_cliente',Auth::guard('clientes')->user()->id)
        ->select('negocios.id','negocios.negocio','negocios.tiponegocio','generadores.razonsocial','negocios.verificado')
        ->orderby('negocios.created_at','desc')
        ->get();

        

        return view('cliente.negocios.index',['negocios'=>$negocios]);
    
    }

    
    public function create()
    {
        $plantas=Planta::all();        
        $tiponegocios=TipoNegocio::All();
        $entidades=Entidad::All();
        $generadores=Generador::where('id_cliente','=',Auth::guard('clientes')->user()->id)->get();
        return view('cliente.negocios.create',['generadores'=>$generadores,'plantas'=>$plantas,'tiponegocios'=>$tiponegocios,'entidades'=>$entidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
       //return $request;
       $id = GetUuid();

       if(!GuardarArchivos($request->plan,'/documentos/negocios/plan/', $id)){
            return Redirect::back()->with('error', 'Error al guardar el plan de menejo.');
        }


        $negocio = new Negocio();
        
        $negocio->id = $id;
        $negocio->id_generador = $request->generador;
        $negocio->id_municipio = $request->municipio;
        $negocio->negocio = $request->negocio;
        $negocio->tiponegocio = $request->tiponegocio;
        $negocio->calle = $request->calle;
        $negocio->numeroext = $request->numeroext;
        $negocio->numeroint = $request->numeroint=='' ? '' : $request->numeroint ;
        $negocio->colonia = $request->colonia;
        $negocio->cp = $request->cp;
        $negocio->latitud = $request->latitud;
        $negocio->longitud = $request->longitud;
        $negocio->correo = $request->correo;
        $negocio->telefono = $request->telefono;
        $negocio->celular = $request->celular;

        $negocio->save();

        return redirect('negocios')->with('success', 'Registro correcto.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        
        $negocio=Negocio::find($id);

        $generador=DB::table('generadores')
        ->where('generadores.id',$negocio->id_generador)
        ->first();

        $planta=DB::table('plantas')
        ->where('plantas.id',$negocio->id_municipio)
        ->first();

        $entidad=DB::table('entidades')
        ->where('id',$negocio->entidad)
        ->first();


        
        return view('cliente.negocios.show',['negocio'=>$negocio,'generador'=>$generador,'planta'=>$planta,'entidad'=>$entidad]);


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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $negocio=Negocio::find($id);
        
        if($negocio->delete()){
            return redirect('negocios')->with('success', 'Se eliminó el registro.');
        }else{
            return redirect('negocios')->with('error', 'Error al eliminar.');
        }
    }


    public function RegistroNegocio(){
        $generadores = Generador::all()
        ->where('id_cliente',Auth::guard('clientes')->user()->id)
        ->where('borrado','1')
        ->where('verificado','1');
        
        
        $configuraciones=DB::table('configuraciones')->first();
      

        $tiponegocio=TipoNegocio::select('tiponegocio','tag')->distinct()->get();
        $subtiponegocio=TipoNegocio::all();
        
        
        $plantas=Planta::all();
        return view('cliente.negocios.registronegocios',['generadores'=>$generadores,'tiponegocios'=>$tiponegocios,'subtiponegocios'=>$subtiponegocios,'plantas'=>$plantas]);
    }



}
