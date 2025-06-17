<?php

namespace App\Http\Controllers\Sedema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Generador;
use App\Models\Negocio;
use App\Models\Recoleccion;
use App\Models\TipoNegocio;
use App\Models\Entidad;
use App\Models\Planta;
use App\Models\Configuracion;
use Redirect;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filtros)
    {
        $negocios = DB::table('negocios')
        ->leftjoin('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('negocios.negocio','like','%'.$filtros->negocio.'%')
        ->select('generadores.razonsocial','negocios.id','negocios.negocio','negocios.tiponegocio','negocios.verificado',
        DB::RAW("(select planta from plantas where id=negocios.id_municipio) as planta"),
        'negocios.latitud','negocios.longitud')
        ->orderby('negocios.created_at','desc')
        ->paginate(15);

        $negociosmarca = DB::table('negocios')
        ->leftjoin('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('negocios.negocio','like','%'.$filtros->negocio.'%')
        ->select('generadores.razonsocial','negocios.id','negocios.negocio','negocios.tiponegocio','negocios.verificado',
        DB::RAW("(select planta from plantas where id=negocios.id_municipio) as planta"),
        'negocios.latitud','negocios.longitud')
        ->orderby('negocios.created_at','desc')
        ->get();

        $marcadores=array();
        foreach($negociosmarca as $key=>$negocio){
           

            /**
             * Poniendo punteros de color 
             */
            $temp=array();
            $temp['id']=$negocio->id;    
            $temp['latitud']=$negocio->latitud;
            $temp['longitud']=$negocio->longitud;
            $temp['negocio']=str_replace('"','',$negocio->negocio); 
            
            $temp['pointer']='pointerdanger.png';
            $marcadores[]=$temp;
        }

        $marcadores=(json_encode($marcadores,true));


        return view('sedema.negocios.negocios',['negocios'=>$negocios,'filtros'=>$filtros,'marcadores'=>$marcadores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plantas=Planta::where('tipo',2)->where('id',GetIdPlanta())->get();
        $tiponegocios=TipoNegocio::All();        
        $entidades=Entidad::All();
        $generadores=Generador::all();
        return view('sedema.negocios.create',['generadores'=>$generadores,'plantas'=>$plantas,'tiponegocios'=>$tiponegocios,'entidades'=>$entidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $negocio = new Negocio();

        $negocio->id=GetUuid();        
        $negocio->id_generador=isset($request->generador) ? $request->generador : '' ;
        $negocio->id_municipio=$request->planta;

        $negocio->negocio=$request->negocio;
        
        $tiponegocio=TipoNegocio::where('id','=',$request->tiponegocio)->first();
        if(!$tiponegocio){
            return Redirect::back()->with('error', 'El tipo de negocio no se encuentra');
        }
        $negocio->tiponegocio=$tiponegocio->tiponegocio;


        $negocio->calle=$request->calle;
        $negocio->numeroext=$request->numeroext;
        $negocio->numeroint=$request->numeroint;
        $negocio->colonia=$request->colonia;
        $negocio->municipio=$request->municipio;
        $negocio->entidad=$request->entidad;
        $negocio->cp=$request->cp;
        $negocio->latitud=$request->latitud;
        $negocio->longitud=$request->longitud;
        $negocio->verificado=1;
        
        //Subir plan de manejo
        $nombre = $negocio->id.'.pdf';
        if(!GuardarArchivos($request->plan,'/documentos/clientes/negocios/plan',$nombre)){
            return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
        }

        $negocio->telefono=$request->telefono;
        $negocio->celular=$request->celular;
        $negocio->correo=$request->correo;

        $confi=Configuracion::select('iva')->where('id_municipio',$request->planta)->first();
        $negocio->iva=$confi->iva;
        

        if($negocio->save()){
            return redirect('establecimientos')->with('success', 'Datos guardados.');
        }else{
            return redirect('establecimientos')->with('error', 'Error al guardar los datos.');
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
        $negocio=Negocio::find($id);
        
        $recolecciones= Recoleccion::select('id',db::raw(" (select residuo from residuos where opcion=recolecciones.residuo) as residuo")
        ,db::raw(" (select unidades from residuos where opcion=recolecciones.residuo) as unidades"),'recolecciones.matriculat'
        ,'residuo as re','cantidad','created_at')
        ->where('id_negocio',$negocio->id)
        ->orderby('created_at','desc')
        ->get();
        
        $tiponegocios=TipoNegocio::all();

        $entidades=Entidad::all();
        $plantas=Planta::all();

        $generador=DB::table('generadores')
        ->where('generadores.id',$negocio->id_generador)
        ->first();

        $planta=DB::table('plantas')
        ->where('plantas.id',$negocio->id_municipio)
        ->first();

        $entidad=DB::table('entidades')
        ->where('entidad',$negocio->entidad)
        ->first();

        $generadores=Generador::all();
        
        return view('sedema.negocios.negocio',['recolecciones'=>$recolecciones,'generadores'=>$generadores,'negocio'=>$negocio,'generador'=>$generador,
        'planta'=>$planta,'plantas'=>$plantas,'entidades'=>$entidades,'entidad'=>$entidad,'tiponegocios'=>$tiponegocios]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    }
  
    
    public function update(Request $request, $id)
    {
        //return $request;

        //negocio->id=GetUuid(); 
        $negocio=Negocio::find($id);      
        $negocio->id_generador=isset($request->generador) ? $request->generador : '' ;
        $negocio->id_municipio=$request->planta;

        $negocio->negocio=$request->negocio;
        
        if(strlen($request->tiponegocio)==32){
            $tiponegocio=TipoNegocio::where('id','=',$request->tiponegocio)->first();
            if(!$tiponegocio){
                return Redirect::back()->with('error', 'El tipo de negocio no se encuentra');
            }
            $negocio->tiponegocio=$tiponegocio->tiponegocio;

        }
        

        $negocio->calle=$request->calle;
        $negocio->numeroext=$request->numeroext;
        $negocio->numeroint=$request->numeroint;
        $negocio->colonia=$request->colonia;
        $negocio->municipio=$request->municipio;
        $negocio->entidad=$request->entidad;
        $negocio->cp=$request->cp;
        $negocio->latitud=$request->latitud;
        $negocio->longitud=$request->longitud;
        $negocio->verificado=1;
        
        //Subir plan de manejo
        if($request->plan!=null){
            $nombre = $negocio->id.'.pdf';
            if(!GuardarArchivos($request->plan,'/documentos/clientes/negocios/plan',$nombre)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
        }
       
        $negocio->contacto=$request->contacto;
        $negocio->telefono=$request->telefono;
        $negocio->celular=$request->celular;
        $negocio->correo=$request->correo;

        $confi=Configuracion::select('iva')->where('id_municipio',$request->planta)->first();
        $negocio->iva=$confi->iva;
        

        if($negocio->save()){
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar los datos.');
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

    
    function Cedula($id){
        $negocio=Negocio::find($id);
        $url=GeneraQR('images/qr/cedula/',str_replace('/','-',$negocio->negocio).'/'.$id);
        return view('formatos.cedulas.cedula',['negocio'=>$negocio,'url'=>$url]);
    }
}
