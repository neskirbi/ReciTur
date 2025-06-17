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
 * Apis Administrador
 */

Route::post('SaldoNegativo','App\Http\Controllers\Administracion\ApiController@SaldoNegativo');
Route::post('CambiaFecha','App\Http\Controllers\Administracion\ApiController@CambiaFecha');
Route::post('CargarFoto','App\Http\Controllers\Administracion\ApiController@CargarFoto');
Route::post('BorrarFoto','App\Http\Controllers\Administracion\ApiController@BorrarFoto');


/**
 * SEDEMA
 */

 
Route::post('AvanceEntregasSedema', 'App\Http\Controllers\Sedema\ApiController@AvanceEntregasSedema');

Route::post('CargaPlantas', 'App\Http\Controllers\Sedema\ApiController@CargaPlantas');



/**
 * Apis clientes
 */

Route::post('AvanceEntregas', 'App\Http\Controllers\Cliente\ApiController@AvanceEntregas');



Route::post('CorreoExisteAdmin', 'App\Http\Controllers\ApisController@CorreoExisteAdmin');

Route::post('CorreoExiste', 'App\Http\Controllers\ApisController@CorreoExiste');

Route::post('GetHoras', 'App\Http\Controllers\ApisController@GetHoras');

Route::post('GetMateriales', 'App\Http\Controllers\ApisController@GetMateriales');

Route::get('GetCategoriasMaterial/{id_municipio}', 'App\Http\Controllers\ApisController@GetCategoriasMaterial');

Route::post('MaterialesObraTodos', 'App\Http\Controllers\ApisController@MaterialesObraTodos');
Route::post('MaterialesObraDeclarados', 'App\Http\Controllers\ApisController@MaterialesObraDeclarados');
Route::post('Matricula', 'App\Http\Controllers\ApisController@Matricula');
Route::post('Razon', 'App\Http\Controllers\ApisController@Razon');
Route::post('SubTipoObra', 'App\Http\Controllers\ApisController@SubTipoObra');

Route::post('GuardarVehiculo', 'App\Http\Controllers\ApisController@GuardarVeiculo');


Route::post('AvanceFecha', 'App\Http\Controllers\ApisController@AvanceFecha');

Route::post('Clientes', 'App\Http\Controllers\ApisController@Clientes');

Route::post('GetGeneradorDatos', 'App\Http\Controllers\ApisController@GetGeneradorDatos');

Route::post('ReportePagos', 'App\Http\Controllers\Administracion\ApiController@ReportePagos');
Route::post('ReporteCitas', 'App\Http\Controllers\Administracion\ApiController@ReporteCitas');
Route::post('ReporteStatusObrasPre', 'App\Http\Controllers\Administracion\ApiController@ReporteStatusObrasPre');

Route::post('ReporteTransportePre', 'App\Http\Controllers\Administracion\ApiController@ReporteTransportePre');



Route::post('DetalleEntregas', 'App\Http\Controllers\ApisController@DetalleEntregas');
Route::post('CatalogoObraProducto', 'App\Http\Controllers\ApisController@CatalogoObraProducto');
Route::post('CatalogoObraTransporte', 'App\Http\Controllers\ApisController@CatalogoObraTransporte');

Route::post('AgregarCarrito', 'App\Http\Controllers\ApisController@AgregarCarrito');

Route::post('PuedeGastar','App\Http\Controllers\General\ApiController@PuedeGastar');




/**
 * Correos
 */


Route::post('CorreoConfirmApi','App\Http\Controllers\CorreoController@CorreoConfirmApi');




Route::post('CargarFotoProducto','App\Http\Controllers\ApisController@CargarFotoProducto');
Route::post('BorrarProductoFoto','App\Http\Controllers\ApisController@BorrarProductoFoto');

/**
 * Apis Android
 */
Route::post('Login','App\Http\Controllers\Android\LoginController@Login');

Route::post('BoletaQr','App\Http\Controllers\Android\CitaController@BoletaQr');



/**
 * Recitrac Transporte
 */

Route::post('Coordenadas','App\Http\Controllers\Android\General\CoordenadaController@Coordenadas');
Route::post('LoginChofer','App\Http\Controllers\Android\RecitrackTransporte\Choferes\LoginController@Login');
Route::post('DataCita','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ScanerController@DataCita');
Route::post('AceptarCita','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ScanerController@AceptarCita');
Route::post('Entregado','App\Http\Controllers\Android\RecitrackTransporte\ScanerController@Entregado');
Route::post('HistorialViajes','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ViajesController@HistorialViajes');

/**
 * Recitrack Recoleccion
 */

Route::post('RecolectorLogin','App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores\LoginController@RecolectorLogin');
Route::post('CargarRecoleccion','App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores\RecoleccionController@CargarRecoleccion');
//Route::post('DatosNegocio','App\Http\Controllers\Android\Recolector\RecoleccionController@DatosNegocio');


 
//Apis Generales


Route::post('MunicipiosApi','App\Http\Controllers\Api\ApiController@MunicipiosApi');



Route::post('EnviarCodigo',function(Request $request){
    
    $length = 5;
    $codigo = substr(str_repeat(0, $length).rand(1,9999), - $length);
    //return EnviarMensaje($request->telefono,'Su numero se ha registrado en reci-track.mx, para confirmar el registro de su número vaya al siguiente link reci-track.mx/ValidacionChofer/'.$id.' .');

    if(Chofer::where('telefono',$request->telefono)->first()){
        return 3;
    }
    if(EnviarMensaje("+52".$request->telefono,'Su numero se ha registrado en reci-trash.mx, Codigo: '.$codigo)){

        
        $pre=new PreVerificacion();
        $pre->id=GetUuid();
        $pre->telefono=$request->telefono;
        $pre->codigo = $codigo;
        $pre->save();
        return 1;
    }else{
        return 0;
    }
    return 0;



});