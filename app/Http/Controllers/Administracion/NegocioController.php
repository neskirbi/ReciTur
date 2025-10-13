<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Generador;
use App\Models\Negocio;
use App\Models\TipoNegocio;
use App\Models\Entidad;
use App\Models\Municipio;
use App\Models\Configuracion;
use App\Models\Clasificacion;
use App\Models\Recoleccion;
use Redirect;

class NegocioController extends Controller
{
   
    
    
    public function __construct(){
        $this->middleware('administradorlogged');
    }
    
    public function index(Request $filtros)
    {
        $negocios = DB::table('negocios')
        ->leftjoin('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('negocios.negocio','like','%'.$filtros->negocio.'%')
        ->select('negocios.id','negocios.negocio','negocios.giro','generadores.razonsocial','negocios.verificado')
        ->orderby('negocios.created_at','desc')
        ->paginate(15);

        return view('administracion.negocios.index',['negocios'=>$negocios,'filtros'=>$filtros]);
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
    $tiponegocios=TipoNegocio::all();
    $entidades=Entidad::all();
    
    $generador=DB::table('generadores')
    ->where('generadores.id',$negocio->id_generador)
    ->first();

    $giros = Clasificacion::select('giro')
    ->distinct()
    ->whereNotNull('giro')
    ->orderBy('giro')
    ->get();
    
    $entidad=DB::table('entidades')
    ->where('entidad',$negocio->entidad)
    ->first();

    $generadores=Generador::all();
   
    $recolecciones=Recoleccion::select('negocios.negocio','negocios.giro','recolecciones.id','recolecciones.created_at')
    ->join('negocios','negocios.id','=','recolecciones.id_negocio')
    ->orderby('recolecciones.created_at','desc')
    ->where('recolecciones.id_negocio',$id)
    ->get();

    // Datos para el gráfico de recolección diaria
    $chartData = [];
    $chartLabels = [];
    
    // Obtener recolecciones de los últimos 30 días agrupadas por día
    $recoleccionesChart = DB::table('recolecciones')
        ->join('recoleccion', 'recoleccion.id_recoleccion', '=', 'recolecciones.id')
        ->select(
            DB::raw('DATE(recolecciones.created_at) as fecha'),
            DB::raw('SUM(recoleccion.cantidad * recoleccion.multiplicador) as cantidad_total')
        )
        ->where('recolecciones.id_negocio', $id)
        ->where('recolecciones.created_at', '>=', now()->subDays(30))
        ->groupBy('fecha')
        ->orderBy('fecha', 'asc')
        ->get();

    foreach ($recoleccionesChart as $item) {
        $chartLabels[] = \Carbon\Carbon::parse($item->fecha)->format('d/m');
        $chartData[] = $item->cantidad_total;
    }

    return view('administracion.negocios.show',[
        'generadores' => $generadores,
        'negocio' => $negocio,
        'generador' => $generador,
        'entidad' => $entidad,
        'entidades' => $entidades,
        'tiponegocios' => $tiponegocios,
        'giros' => $giros,
        'recolecciones' => $recolecciones,
        'chartData' => $chartData,
        'chartLabels' => $chartLabels
    ]);
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


        $clasificacion = Clasificacion::WhereRaw("giro = '".$request->giro."' and de <= ".$request->cantidad." and a >= ".$request->cantidad."  ")->first();

        $cla='';
        $uni='';
        if($clasificacion){
            $cla = $clasificacion->clasificacion;
            $uni = $clasificacion->unidades;
        }

        $entidad = Entidad::where('id',$request->entidad)->first();

        
        
        $negocio=Negocio::find($id);      
        
        $negocio->id_generador = $request->generador;
        $negocio->id_municipio = $request->municipio;
        $negocio->negocio = $request->negocio;
        $negocio->giro = $request->giro;
        $negocio->cantidad = $request->cantidad;
        $negocio->unidades = $uni;
        $negocio->estimado = $request->estimado;
        $negocio->clasificacion = $cla;
        $negocio->calle = $request->calle;
        $negocio->numeroext = $request->numeroext;
        $negocio->numeroint = $request->numeroint=='' ? '' : $request->numeroint ;
        $negocio->colonia = $request->colonia;
        $negocio->cp = $request->cp;
        $negocio->entidad = $entidad->entidad;
        $negocio->municipio = $request->municipio;
        $negocio->latitud = $request->latitud;
        $negocio->longitud = $request->longitud;
        $negocio->contacto = $request->contacto;
        $negocio->correo = $request->correo;
        $negocio->telefono = $request->telefono;
        $negocio->celular = $request->celular;
        $negocio->verificado = 1;
        

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
        $url=GeneraQR('images/qr/cedula/',$id,$id);
        return view('formatos.cedulas.cedula',['negocio'=>$negocio,'url'=>$url]);
    }

    
}
