<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Entidad;
use App\Models\Municipio;

class ApiController extends Controller
{
    function MunicipiosApi(Request $request){
        return$municipios=Entidad::join('municipios','municipios.id_entidad','=','entidades.id')
        ->select('municipios.id','municipios.municipio')
        ->where('entidades.id',$request->entidad)
        ->orderby('municipios.municipio','asc')
        ->get();
    }
}
