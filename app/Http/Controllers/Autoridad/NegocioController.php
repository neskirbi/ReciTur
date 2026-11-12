<?php

namespace App\Http\Controllers\Autoridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Generador;
use App\Models\Negocio;
use App\Models\TipoNegocio;
use App\Models\Entidad;
use App\Models\Clasificacion;
use Redirect;

class NegocioController extends Controller
{
    public function index(Request $filtros)
    {
        $negocios = DB::table('negocios')
        ->leftjoin('generadores', 'generadores.id', '=', 'negocios.id_generador')
        ->where('negocios.negocio','like','%'.$filtros->negocio.'%')
        ->select('negocios.id','negocios.negocio','negocios.giro','generadores.razonsocial','negocios.verificado')
        ->orderby('negocios.created_at','desc')
        ->paginate(15);

        return view('autoridad.negocios.index',['negocios'=>$negocios,'filtros'=>$filtros]);
    }

    public function show($id)
    {
        $negocio      = Negocio::find($id);
        $tiponegocios = TipoNegocio::all();
        $entidades    = Entidad::all();

        $generador = DB::table('generadores')->where('generadores.id',$negocio->id_generador)->first();

        $giros = Clasificacion::select('giro')->distinct()->whereNotNull('giro')->orderBy('giro')->get();

        $entidad = DB::table('entidades')->where('entidad',$negocio->entidad)->first();

        $generadores = Generador::all();

        $recolecciones = DB::table('recolecciones')
            ->join('negocios', 'negocios.id', '=', 'recolecciones.id_negocio')
            ->leftJoin('recoleccion', 'recoleccion.id_recoleccion', '=', 'recolecciones.id')
            ->select(
                'negocios.negocio','negocios.giro','recolecciones.id','recolecciones.created_at',
                'recoleccion.residuo','recoleccion.cantidad','recoleccion.multiplicador','recoleccion.unidades',
                DB::raw('(recoleccion.cantidad * recoleccion.multiplicador) as cantidad_calculada')
            )
            ->where('recolecciones.id_negocio', $id)
            ->orderBy('recolecciones.created_at', 'desc')
            ->get();

        $chartData = [];
        $chartLabels = [];

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
            $chartData[]   = $item->cantidad_total;
        }

        return view('autoridad.negocios.show', [
            'generadores'  => $generadores,
            'negocio'      => $negocio,
            'generador'    => $generador,
            'entidad'      => $entidad,
            'entidades'    => $entidades,
            'tiponegocios' => $tiponegocios,
            'giros'        => $giros,
            'recolecciones'=> $recolecciones,
            'chartData'    => $chartData,
            'chartLabels'  => $chartLabels
        ]);
    }

    public function update(Request $request, $id)
    {
        $clasificacion = Clasificacion::WhereRaw("giro = '".$request->giro."' and de <= ".$request->cantidad." and a >= ".$request->cantidad."  ")->first();

        $cla='';
        $uni='';
        if($clasificacion){
            $cla = $clasificacion->clasificacion;
            $uni = $clasificacion->unidades;
        }

        $entidad = Entidad::where('id',$request->entidad)->first();

        $negocio = Negocio::find($id);

        $negocio->id_generador = $request->generador;
        $negocio->id_municipio = $request->municipio;
        $negocio->negocio      = $request->negocio;
        $negocio->giro         = $request->giro;
        $negocio->cantidad     = $request->cantidad;
        $negocio->unidades     = $uni;
        $negocio->estimado     = $request->estimado;
        $negocio->clasificacion= $cla;
        $negocio->calle        = $request->calle;
        $negocio->numeroext    = $request->numeroext;
        $negocio->numeroint    = $request->numeroint=='' ? '' : $request->numeroint;
        $negocio->colonia      = $request->colonia;
        $negocio->cp           = $request->cp;
        $negocio->entidad      = $entidad->entidad;
        $negocio->municipio    = $request->municipio;
        $negocio->latitud      = $request->latitud;
        $negocio->longitud     = $request->longitud;
        $negocio->contacto     = $request->contacto;
        $negocio->correo       = $request->correo;
        $negocio->telefono     = $request->telefono;
        $negocio->celular      = $request->celular;
        $negocio->verificado   = 1;

        if($negocio->save()){
            return Redirect::back()->with('success', 'Datos guardados.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar los datos.');
        }
    }

    function Cedula($id){
        $negocio = Negocio::find($id);
        $url = GeneraQR('images/qr/cedula/',$id,$id);
        return view('formatos.cedulas.cedula',['negocio'=>$negocio,'url'=>$url]);
    }
}