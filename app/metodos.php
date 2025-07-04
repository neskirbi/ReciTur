<?php
use App\Mail\Notificaciones;
use App\Models\Token;
use App\Models\Historial;
use App\Models\Cita;
use App\Models\Planta;
use App\Models\Vehiculo;
use App\Models\Chofer;
use Kreait\Firebase\Factory;

function Version(){
    return rand(1,100);
    return 4;
}

function GetSiglas($opcion){
    switch($opcion){
        
        case 0:
            return 'Soporte';
            break;

        case 2:
            return 'Reci-Trash';
        break;
    }
}

function BuscarCorreo($mail){
    $res='';

    if(DB::table('directores')->where('mail',$mail)->first()){
        $res='Directores';
    }

    if(DB::table('administradores')->where('mail',$mail)->first()){
        $res='Administradores';
    }


    if(DB::table('clientes')->where('mail',$mail)->first()){
        $res='Clientes';
    }

     if(DB::table('recolectores')->where('mail',$mail)->first()){
        $res='Recolectores';
    }

    return $res;

}

function GetId(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->id;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->id;
    }  
    
    if(Auth::guard('clientes')->check()){
        return Auth::guard('clientes')->user()->id;
    }  
    
    if(Auth::guard('recolectores')->check()){
        return Auth::guard('recolectores')->user()->id;
    }  

}

function GetIdMunicipio(){
    
    //return'algo';
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->id_municipio;
    }  
    
}

function GetNombre(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->director;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->administrador;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->nombre;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->nombre;
    }  

    if(Auth::guard('clientes')->check()){
        return Auth::guard('clientes')->user()->nombres;
    }  
}



function GetApellidos(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->director;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->administrador;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->nombre;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->nombre;
    }  

    if(Auth::guard('clientes')->check()){
        return Auth::guard('clientes')->user()->apellidos;
    }  
}

function RevisaDatosVehiculos($request,$id){

    $vehiculos=Vehiculo::join('empresastransporte','empresastransporte.id','=','vehiculos.id_empresa')
    ->where('empresastransporte.id','=',$id)
    ->get();
    foreach($vehiculos as $vehiculo){
        Cita::where('matricula', $vehiculo->matricula)
        ->update([
            'razonvehiculo' => $request->razonsocial,
            'ramir' => $request->ramir,
            'direccionvehiculo' => $request->domicilio
        ]);
    }
    


}


function GetCargo(){
    
    if(Auth::guard('directores')->check()){
        return "Director";
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->cargo;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->cargo;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return 'Vendedor';
    }  
}

function GetMail(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->mail;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->mail;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->mail;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->mail;
    }  
}

function EnviarMensaje($numeros,$mensaje){
    
    $instasentClient = new Instasent\SmsClient("8b7953a5fe24c0c838830616ae4dc24db98a8945");
    $response = $instasentClient->sendUnicodeSms('Recitrack', $numeros, $mensaje);
    //return $response['response_code'];
    if(intval($response['response_code'])>=199 && intval($response['response_code'])<=300){
        return 1;
    }else{
        return 0;
    }
}

function RevisarSesiones($sesiones){
    $abiertas=0;
    foreach($sesiones as $sesion){
        if(Auth::guard($sesion)->check()){
            $abiertas++;
        }
    }
    if($abiertas>0){
        return false;
    }
    return redirect('home')->with('warning','Sesión finalizada.');
}

function GetUuid(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
    return str_replace("-","",vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
}


function GetDateTimeNow(){
    return date('Y-m-d H:i:s');
}


function CrearRuta($ruta){
    $ruta=public_path().'/'.$ruta;
    if(!is_dir($ruta))
        mkdir($ruta, 0777,true);
        return $ruta;
}

function GuardarArchivos($file,$ruta,$nombre){
    $ruta=public_path().$ruta;
    if(!is_dir($ruta))
        mkdir($ruta, 0777,true);

    if(file_exists($ruta.'/'.$nombre))             
        unlink($ruta.'/'.$nombre);

    if($file->move($ruta, $nombre)){
        return true;
    }else{
        return false;
    }

}

function MesesEspanol($fecha){
    $fecha=explode("/",$fecha);
    $mes=$fecha[1];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $fecha[1]=$meses[$mes-1];
    return implode("/",$fecha);
}

function MesEspanol($mes){
    
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $mes=$meses[$mes-1];
    return $mes;
}

function FechaFormateada($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio;
}

function FechaFormateadaTiempo($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio.' '.date(' H:i',strtotime($fecha));
}

function FechaFormateadaContratos($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' de '.$mes.' del '.$anio;
}


/**
 * 
 * Revisa el monto por planta , revisa el gasto de reciclaje y el gasto 
 * de pedidos y calcula si puede agregar el gasto nuevo son pasarse del monto de saldo disponible
 * y revisa si el cliente puede generar gastos sin saldo
 */
function PuedeGastar($id_obra,$monto){

    
  
    /**
     * Si puede pospago regresas true, para que revisas si le alcansa o no jejejejej
     */
    //return GastoPedidos($cliente->id_cliente,$cliente->id_municipio);
    if(PuedePospago($id_obra)){
        return true;
    }

    $pago = PagoPorObra($id_obra);
    $recoleccion = GastoRecoleccion($id_negocio);
    
    if(($pago-$reciclaje-$monto-$pedidos)<-2){
        return false;
    }else{
        return true;
    }
    
    
    
}


function PagoPorObra($id_obra){
    $pago = DB::table('pagos')
        ->where('pagos.id_obra',$id_obra)       
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}








/**
 * Valida si tiene transporte disponible en sus pedidos
 */



/**
 * Pagos por cliente, no importa que planta 
 */
function Pago($id_cliente){
    $pago = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id_cliente)        
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}

/**
 * Pago por cliente en cada planta 
 */
function PagoPorPlanta($id_cliente,$id_municipio){
    $pago = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id_cliente) 
        ->where('pagos.id_municipio',$id_municipio)       
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}









function Descuento($monto,$id_cliente){
    
    $descuento = DB::table('descuentos')
        ->where('id_cliente',$id_cliente)
        ->first();

    if($descuento){
        return ($monto-($monto*(($descuento->porcentaje)/100)));
    }else{
        return $monto;
    }
}




function CantidadLetras($numero){
    $formatterES = new NumberFormatter("Es", NumberFormatter::SPELLOUT);
    return $formatterES->format($numero);
} 

function SumarDias($fecha,$dias){
    
    return date('Y-m-d',strtotime ( '+'.($dias).' days' , strtotime ($fecha) ));
}

function Notificar($subject,$title,$subtitle,$body,$correos,$links){
    $correo=new Notificaciones($subject,$title,$subtitle,$body,$links);
    Mail::to($correos)->queue($correo);
}

function TokenGen($mail){
    $id=GetUuid();
    $token=Token::where('mail',$mail)->first();
    
   
    if($token){
        $token=Token::find($token->id);
        $token->delete();
    }
    
    $token=new Token();        
    $token->id=$id;
    $token->token=password_hash($id,PASSWORD_DEFAULT);
    $token->mail=$mail;
    if($token->save()){
        return $id;      
    }else{
        return false;
    }


}

function Historial($tabla,$id_referencia,$id_adminsitrador,$movimiento,$detalle){
    $historial=new Historial();
    $historial->id=GetUuid();
    $historial->tabla=$tabla;
    $historial->id_referencia=$id_referencia;
    $historial->id_administrador=$id_adminsitrador;
    $historial->movimiento=$movimiento;
    $historial->detalle=$detalle;
    $historial->save();
}

/**Este metodo regrasa false si esta bien la conexion y si esta mal regresa true */
function VerificarConexion($conectionName){
    // Test database connection
    try {
        DB::connection($conectionName)->getPdo();
    } catch (\Exception $e) {
        return true;
    }
    return false;
}

function TieneObrasAdmin(){
    $plantas=DB::table('plantas')
        ->select('plantas.id')
        ->where('plantas.id',Auth::guard('administradores')->user()->id_municipio)
        ->where('plantas.tipo',1)
        ->get();
    return count($plantas);
}


function TieneNegociosAdmin(){
    $plantas=DB::table('plantas')
        ->select('plantas.id')
        ->where('plantas.id',Auth::guard('administradores')->user()->id_municipio)
        ->where('plantas.tipo',2)
        ->get();
    return count($plantas);
}



function TieneNegocios(){

    $negocios=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('negocios','negocios.id_generador','=','generadores.id')
        ->select('negocios.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->get();
    return count($negocios);
   
}

function Entregado($cita){
    $citan=new Cita();
    $citan->id=$cita->id;
    $file=public_path("key/recitrack-a87ef-firebase-adminsdk-smctc-1f5c9b7255.json");
    if(file_exists($file)){
        $firebase= (new Factory)->withServiceAccount($file); 
        $db=$firebase->createDatabase();
        $reference = $db->getReference("Citas/Confirmadas/".$citan->id);
        
        $reference->set($citan);
        return true;
    }else{
        return false;
    } 
   
}

function GeneraQR($path,$texto){
    
    if(!is_dir(public_path().'/'.$path))
        mkdir(public_path().'/'.$path, 0777,true);
        
$nombre=GetUuid().'.png';


$url= ($path.$nombre);
\QRCode::text($texto)->setOutfile($url)->png(); 
return $url;

}


function PostmanAndroid($request){
    if(isset($request->android)){
        $request=$request->android;
    }else{
        $request=str_replace("\"",'"',json_encode($request->all()));
    }
    return json_decode($request,1);
}




function ArchivoPorNombre($directorio, $nombreSinExtension) {
    // Verificar si el directorio existe
    if (!is_dir($directorio)) {
        return null;
    }
    
    // Escanear el directorio
    $archivos = scandir($directorio);
    
    foreach ($archivos as $archivo) {
        // Ignorar directorios especiales . y ..
        if ($archivo === '.' || $archivo === '..') {
            continue;
        }
        
        // Obtener el nombre sin extensión y comparar
        $nombreArchivo = pathinfo($archivo, PATHINFO_FILENAME);
        
        if ($nombreArchivo === $nombreSinExtension) {
            return $archivo; // Devuelve el nombre completo con extensión
        }
    }
    
    return null; // No se encontró el archivo
}




function TipoPlanta(){
    $planta=Planta::where('id',Auth::guard('administradores')->user()->id_municipio)->first();
    return $planta->tipo;
}
?>
