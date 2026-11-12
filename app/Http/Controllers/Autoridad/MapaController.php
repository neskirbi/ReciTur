<?php

namespace App\Http\Controllers\Autoridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Negocio;
use App\Models\Clasificacion;

class MapaController extends Controller
{
    public function index(Request $filtros)
    {
        $negocios = Negocio::select('id','negocio','latitud','longitud','solicitud','clasificacion')->get();
        $negocios2 = Negocio::select('negocio','latitud','longitud','solicitud','clasificacion')
        ->whereraw("clasificacion like '%".$filtros->clasificacion."%'")
        ->orderby('solicitud','desc')->orderby('negocio','asc')->paginate(15);
        $clasificaciones = Clasificacion::all();
        return view('autoridad.mapas.index',['negocios'=>$negocios,'negocios2'=>$negocios2,'clasificaciones'=>$clasificaciones,'filtros'=>$filtros]);
    }
}