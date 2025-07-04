<?php

namespace App\Http\Controllers\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recoleccion;
use Redirect;


class RecoleccionController extends Controller
{


    public function __construct(){
        $this->middleware('recolectorlogged');
    }


    
    function index(){
        $recolecciones=Recoleccion::join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->where('recolecciones.id_recolector',GetId())
        ->orderby('recolecciones.created_at','desc')
        ->paginate(15);
        return view('recolectores.recolecciones.index',['recolecciones'=>$recolecciones]);
    }
}
