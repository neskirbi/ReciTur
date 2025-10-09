<?php

namespace App\Http\Controllers\Cliente;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Generador;
use App\Models\Entidad;
use Redirect;

class GeneradoresController extends Controller
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
        $generadores = DB::table('generadores')
        ->where('id_cliente',Auth::guard('clientes')->user()->id)
        ->orderby('created_at','desc')
        ->get();

        
        //return $generadores;
        
        return view('cliente.generadores.index',['generadores'=>$generadores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $entidades = Entidad::all();
        return view('cliente.generadores.create',['entidades'=>$entidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $generador = new Generador();
        $generador->id = GetUuid();
        $generador->id_cliente = Auth::guard('clientes')->user()->id;

        // Campos básicos
        $generador->razonsocial = $request->razonsocial;
        $generador->fisicaomoral = isset($request->fisicaomoral) ? $request->fisicaomoral : '';
        $generador->rfc = isset($request->rfc) ? $request->rfc : '';

        // Dirección
        $generador->calle = $request->calle;
        $generador->numeroext = $request->numeroext;
        $generador->numeroint = isset($request->numeroint) ? $request->numeroint : '';
        $generador->colonia = $request->colonia;
        $generador->entidad = $request->entidad;
        $generador->municipio = $request->municipio;
        $generador->cp = $request->cp;

        // Contacto
        $generador->telefono = $request->telefono;
        $generador->celular = $request->celular;
        $generador->mail = $request->mail;

       if($generador->save()){
            return redirect('generadores')->with('success', 'Generador creado correctamente');
        }else{
            return redirect('generadores')->with('error', 'Error al crear el generador');
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
        $generador = Generador::find($id);

        $negocios = DB::table('negocios')
        ->select('negocios.id','negocios.negocio','negocios.giro','generadores.razonsocial',
        'negocios.verificado','negocios.solicitud')
        ->join('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('generadores.id_cliente',Auth::guard('clientes')->user()->id)
        ->where('generadores.id',$id)        
        ->orderby('negocios.created_at','desc')
        ->get();


        return view('cliente.generadores.show',['generador'=>$generador,'negocios'=>$negocios]);
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
    public function destroy($id){
      $generador = Generador::find($id);
      $generador->delete();
      return redirect('generadores')->with('error','Generador Borrado.');
    }

    /**
     * Notificacion por correo de la alta del Generador
     */

    
}
