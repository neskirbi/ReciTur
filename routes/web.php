<?php
use App\Http\Controllers\FormatosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionMail;
use App\Models\Token;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * Redirecciona del home al panel si es que ya esta logueado
 */
Route::get('/', function () {
    return redirect('home');
})->name('home');


/**
 * Redirecciona del home al panel si es que ya esta logueado
 */
Route::get('home', function () {
    if(Auth::guard('directores')->check()){
        return redirect('graficas');
    }   

    if(Auth::guard('administradores')->check()){
        return redirect('establecimientos');
    }  

    if(Auth::guard('vendedores')->check()){
        return redirect('ventas');
    } 

    if(Auth::guard('recepciones')->check()){
        return redirect('cita');
    } 

    if(Auth::guard('finanzas')->check()){
        return redirect('pagosfi');
    }     

    if(Auth::guard('clientes')->check()){
        return redirect('homec');
    }    
    
    if(Auth::guard('transportistas')->check()){
        return redirect('empresas');
    }  

    
    
    return view('home');
});






/**
 * Rutas generales
 */
Route::get('Manifiesto/{id}', 'App\Http\Controllers\General\GeneralController@Manifiesto');

Route::get('terminosycondiciones',function(){
    return view('formatos.terminosycondiciones');
});


/**
 * registro de clientes
 */
Route::resource('clientes', 'App\Http\Controllers\ClienteController');

/**
 * Logins
 */


Route::get('acceso',function(){
    return view('asociados.login.login');
});


Route::get('PassReset',function(){
    return view('cliente.extras.passreset');
});

Route::post('Recuperar','App\Http\Controllers\LoginController@Recuperar');
Route::get('Recuperar/{id}',function($id){
    $token=Token::find($id);
    if($token){
        return view('cliente.extras.pass',['id'=>$id]);
    }else{
        return redirect('home')->with('error','No se encontró la petición o ya se ultilizó el link anteriormente.');
    }
});
Route::post('GuardarPass/{id}','App\Http\Controllers\LoginController@GuardarPass');

Route::post('loginasociado', 'App\Http\Controllers\LoginController@authenticateasociado');
Route::post('loginadmin', 'App\Http\Controllers\LoginController@authenticateadmin');


Route::get('loginpage',function(){
    return view('loginpage');
});

Route::get('registropage', function () {
    return view('registro');
});


Route::post('Registro', 'App\Http\Controllers\RegistroController@Registro');

Route::post('Login', 'App\Http\Controllers\LoginController@Login');
Route::post('login2', 'App\Http\Controllers\LoginController@authenticate');

Route::post('loginresidentes', 'App\Http\Controllers\LoginController@authenticateresidentes');

Route::post('logintransport', 'App\Http\Controllers\LoginController@authenticatetransportista');

Route::get('logout', 'App\Http\Controllers\LoginController@logout');




//Ruta centros de acopio

Route::resource('campamentos', 'App\Http\Controllers\CampamentoController');



/**
 * Rutas para clientes
 */


Route::resource('homec', 'App\Http\Controllers\Cliente\HomeController');

Route::get('GraficasPagosCliente','App\Http\Controllers\Cliente\DashboardController@GraficasPagosCliente');

Route::resource('generadores', 'App\Http\Controllers\Cliente\GeneradoresController');

Route::get('registrogenerador','App\Http\Controllers\RegistroGeneradoresController@index');

Route::resource('negocios','App\Http\Controllers\Cliente\NegocioController');


Route::resource('recolecciones','App\Http\Controllers\Cliente\RecoleccionController');




/**
 * Rutas Asociacion
 */

Route::resource('etransporte', 'App\Http\Controllers\Asociacion\ETransporteController');

Route::resource('generadorasoc', 'App\Http\Controllers\Asociacion\GeneradorController');
Route::resource('catalogosasoc', 'App\Http\Controllers\Asociacion\CatalogosController');





Route::resource('municipios','App\Http\Controllers\Asociacion\MunicipioController');
Route::get('administradoresasoc/{id}','App\Http\Controllers\Asociacion\AdministradorController@Administradores');

Route::post('CreateAdmin','App\Http\Controllers\Asociacion\AdministradorController@CreateAdmin');

Route::put('UpdateDirector/{id}','App\Http\Controllers\Asociacion\AdministradorController@UpdateDirector');
Route::post('DeleteDirector/{id}','App\Http\Controllers\Asociacion\AdministradorController@DeleteDirector');

Route::put('UpdateAdmin/{id}','App\Http\Controllers\Asociacion\AdministradorController@UpdateAdmin');
Route::post('DeleteAdmin/{id}','App\Http\Controllers\Asociacion\AdministradorController@DeleteAdmin');


Route::put('UpdateFinanza/{id}','App\Http\Controllers\Asociacion\AdministradorController@UpdateFinanza');
Route::post('DeleteFinanza/{id}','App\Http\Controllers\Asociacion\AdministradorController@DeleteFinanza');



Route::post('plantareg','App\Http\Controllers\Asociacion\PlantaController@PlantaReg');

Route::put('ActivarPlanta/{id}','App\Http\Controllers\Asociacion\PlantaController@ActivarPlanta');

Route::put('InactivarPlanta/{id}','App\Http\Controllers\Asociacion\PlantaController@InactivarPlanta');

Route::resource('sedemas', 'App\Http\Controllers\Asociacion\SedemaController');
Route::get('quitarsedema/{id}','App\Http\Controllers\Asociacion\SedemaController@QuitarSedema');




Route::resource('sedeman', 'App\Http\Controllers\Sedema\NegocioController');


Route::resource('configuracionasoc','App\Http\Controllers\Asociacion\ConfiguracionController');



/**
 * Rutas para guardar catalogo que todas apuntan al controlador Asociacion\CatalogosController.
 */






Route::post('guardarcategoriamaterial', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCategoriaMaterial');
Route::get('borrarcategoriamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCategoriaMaterial');

Route::post('guardarmaterial', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarMaterial');
Route::put('actualizamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@ActualizaMaterial');
Route::get('borrarmaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarMaterial');

Route::post('guardarcondicion', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCondicion');
Route::get('borrarcondicion/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCondicion');


Route::put('GuardarDatosPlantaAsoc/{id}', 'App\Http\Controllers\Asociacion\ConfiguracionController@GuardarDatosPlanta');

Route::post('GuardarDatosBancoAsoc/{id}', 'App\Http\Controllers\Asociacion\ConfiguracionController@GuardarDatosBancoAsoc');

/**
 * Confirmaciones de generadores, obras y no se que mas vaya a haber
 */

Route::get('confirmargenerador/{id}', 'App\Http\Controllers\Asociacion\GeneradorController@ConfirmarGenerador');

Route::resource('generador', 'App\Http\Controllers\Asociacion\GeneradorController');


Route::get('BorrarGenerador/{id}', 'App\Http\Controllers\Asociacion\GeneradorController@BorrarGenerador');




/**
 * Rutas para administradores
 */

 Route::resource('planta','App\Http\Controllers\Administracion\PlantaController');

Route::post('EditarAdmin/{id}','App\Http\Controllers\Administracion\PlantaController@EditarAdmin');
Route::get('BorrarAdmin/{id}','App\Http\Controllers\Administracion\PlantaController@BorrarAdmin');


Route::resource('pagos', 'App\Http\Controllers\Administracion\PagoController');
Route::post('CancelarPago/{id}', 'App\Http\Controllers\Administracion\PagoController@CancelarPago');
Route::post('VerificarPago/{id}', 'App\Http\Controllers\Administracion\PagoController@VerificarPago');
Route::post('CargarPagos', 'App\Http\Controllers\Administracion\PagoController@CargarPagos');


Route::resource('catalogos', 'App\Http\Controllers\Administracion\CatalogoController');






Route::resource('recolectores','App\Http\Controllers\Administracion\RecolectorController');

Route::get('BorrarRecolector/{id}','App\Http\Controllers\Administracion\RecolectorController@BorrarRecolector');


Route::resource('vehiculos','App\Http\Controllers\Administracion\VehiculoController');
Route::get('BorrarRecolector/{id}','App\Http\Controllers\Administracion\RecolectorController@BorrarRecolector');

Route::resource('recoleccion','App\Http\Controllers\Administracion\RecoleccionController');


Route::resource('citasfecha', 'App\Http\Controllers\Administracion\CitasFechaController');

Route::resource('configuracion', 'App\Http\Controllers\Administracion\ConfiguracionController');

Route::post('configuracioncuenta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionCuenta');
Route::post('ConfiguracionRepresentante', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionRepresentante');
Route::post('configuracionbanco', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBanco');
Route::post('configuracionboleta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBoleta');
Route::put('GuardarDatosPlanta/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@GuardarDatosPlanta');
Route::post('CambioPass/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@CambioPass');

Route::post('GuardarEmpresaTransporte', 'App\Http\Controllers\Administracion\ConfiguracionController@GuardarEmpresaTransporte');


Route::post('Residuo', 'App\Http\Controllers\Administracion\ConfiguracionController@Residuo');
Route::post('BorrarResiduo/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@BorrarResiduo');

Route::post('Contenedor', 'App\Http\Controllers\Administracion\ConfiguracionController@Contenedor');
Route::post('BorrarContenedor/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@BorrarContenedor');

Route::resource('administradores', 'App\Http\Controllers\Administracion\AdministradorController');
Route::resource('establecimientos', 'App\Http\Controllers\Administracion\NegocioController');

Route::get('cedula/{id}','App\Http\Controllers\Administracion\NegocioController@Cedula');

Route::get('imagenes',function(){
    return view('administracion.citas.imagenes');
});



Route::resource('friday','App\Http\Controllers\Administracion\FridayController');


Route::resource('reportes', 'App\Http\Controllers\Administracion\ReporteController');
Route::get('ReportePagosAdministracion/{id_municipio}/{mes}/{anio}', 'App\Http\Controllers\Administracion\ReporteController@ReportePagosAdministracion');
Route::get('ReporteCitasAdministracion/{id_obra}/{ini}/{fin}/{id_municipio}/{fotos}', 'App\Http\Controllers\Administracion\ReporteController@ReporteCitasAdministracion');
Route::get('ReporteTransporte/{id_obra}/{ini}/{fin}/{id_municipio}', 'App\Http\Controllers\Administracion\ReporteController@ReporteTransporte');
Route::get('ReporteStatusObraAdministracion/{id_municipio}', 'App\Http\Controllers\Administracion\ReporteController@ReporteStatusObraAdministracion');

Route::resource('crm','App\Http\Controllers\Administracion\CrmController');

Route::resource('entregas','App\Http\Controllers\Administracion\EntregaController');






/**
 * Recuperacion de contraseñas 
 */
Route::post('RecuperarAdmin','App\Http\Controllers\LoginController@RecuperarAdmin');

Route::get('AdminPass/{id}',function($id){
    $token=Token::find($id);
    if($token){
        return view('administracion.extras.pass',['id'=>$id]);
    }else{
        return redirect('home')->with('error','No se encontró la petición o ya se ultilizó el link anteriormente.');
    }
});



Route::post('GuardarPassAdmin/{id}','App\Http\Controllers\LoginController@GuardarPassAdmin');





/**
 * Sacar formatos por id
 */
Route::get('contrato/{id}', 'App\Http\Controllers\FormatosController@Contrato');
Route::get('transferencia/{id}', 'App\Http\Controllers\FormatosController@Transferencia');





/**
 * Correos
 */


Route::get('confirmacion/{id}','App\Http\Controllers\LoginController@Confirmacion');


Route::get('confirmaciont/{id}','App\Http\Controllers\LoginController@Confirmaciont');




/**
 * Rutas android
 */
Route::get('TCRecitrackTrasporte',function(){
    return view('formatos.TCRecitrackTrasporte');
});





  /**
   * 
   * Rutas encuestas
   */

   Route::get('encuestas',function(){
       return redirect('hoteles');
   });

   Route::resource('hoteles','App\Http\Controllers\Encuestas\HotelController');

   Route::resource('restaurantes','App\Http\Controllers\Encuestas\RestauranteController');
   Route::get('reportehoteles','App\Http\Controllers\Encuestas\HotelController@reportehoteles');
   Route::get('reporterestaurantes','App\Http\Controllers\Encuestas\RestauranteController@reporterestaurantes');

  

    /**
     * Ruta Recolectores
     */

     
    Route::get('ConfirmacionRecolector/{id}','App\Http\Controllers\Android\Recolector\LoginController@ConfirmacionRecolector');

    
    




/**
 * Rutas desarrollo para tareas
 */

 Route::get('Fotos','App\Http\Controllers\Desarrollo\TareasController@Fotos');
 Route::get('Pass123','App\Http\Controllers\Desarrollo\TareasController@Pass123');
 
 Route::get('Contratos','App\Http\Controllers\Desarrollo\TareasController@Contratos');

 Route::get('Limite/{id}','App\Http\Controllers\Desarrollo\TareasController@Limite');


 Route::resource('ModoDios', 'App\Http\Controllers\Soporte\ModoDiosController');

 Route::post('LoginMD', 'App\Http\Controllers\Soporte\ModoDiosController@LoginMD');
 



 /**
  * Rutas soporte 
  */

  Route::get('soporte',function(){

    if(Auth::guard('soporte')->check()){
        return redirect('vehiculossoporte');
    }  

    return view('soporte.login.login');
});

Route::resource('empresassoporte', 'App\Http\Controllers\Soporte\EmpresaController');

Route::post('loginsoporte','App\Http\Controllers\Soporte\LoginController@LoginSoporte');
Route::resource('vehiculossoporte','App\Http\Controllers\Soporte\VehiculoController');







/**
 * Transportistas
 */
Route::resource('registrot','App\Http\Controllers\WebApp\Transportista\RegistroTController');
