<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use Redirect;


class RecoleccionController extends Controller
{


    public function __construct(){
        $this->middleware('clientelogged');
    }


    
    function index(){
        $recolecciones=Cliente::join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('negocios','negocios.id_generador','=','generadores.id')
        ->join('recolecciones','recolecciones.id_negocio','=','negocios.id')
        ->where('clientes.id',GetId())
        ->orderby('recolecciones.created_at','desc')
        ->get();
        return view('cliente.recolecciones.index',['recolecciones'=>$recolecciones]);
    }
}
