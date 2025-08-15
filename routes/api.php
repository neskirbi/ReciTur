<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\PreVerificacion;
use App\Models\Chofer;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Recitur
 */
Route::post('MunicipiosApi','App\Http\Controllers\Api\ApiController@MunicipiosApi');


Route::post('GetUnidadesClasificacion','App\Http\Controllers\Api\Clientes\ApiController@GetUnidadesClasificacion');

