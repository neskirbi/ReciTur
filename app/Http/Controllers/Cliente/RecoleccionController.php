<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use Redirect;


class RecoleccionController extends Controller
{
    function index(){
        $recolecciones=Cliente::select('recolecciones.id','negocios.negocio','recolecciones.cantidad','negocios.tiponegocio','recolecciones.created_at',
        DB::RAW("(select contenedor from contenedores where opcion=recolecciones.contenedor) as contenedor"),
        DB::RAW("(select residuo from residuos where opcion=recolecciones.residuo) as residuo"),
        DB::RAW("(select plantaauto from plantas where id=recolecciones.id_municipio) as plantaauto"))
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('negocios','negocios.id_generador','=','generadores.id')
        ->join('recolecciones','recolecciones.id_negocio','=','negocios.id')
        ->where('clientes.id',GetId())
        ->orderby('created_at','desc')
        ->get();
        return view('cliente.recolecciones.recolecciones',['recolecciones'=>$recolecciones]);
    }
}
