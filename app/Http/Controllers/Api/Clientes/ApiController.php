<?php

namespace App\Http\Controllers\Api\Clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clasificacion;

class ApiController extends Controller
{
    function GetUnidadesClasificacion(Request $request){
         return $giros = Clasificacion::select('unidades')->where('giro',$request->clasificacion)->first();
    }
}
