<?php

namespace App\Http\Controllers\Desarrollo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asociado;
use App\Models\Director;
use App\Models\Administrador;
use App\Models\Vendedor;
use App\Models\Recepcion;
use App\Models\Finanza;
use App\Models\Cliente;
use App\Models\Residente;
use App\Models\Cita;
use App\Models\Obra;
use App\Models\Transportista;

class TareasController extends Controller
{
    

    function Fotos(){
      $citas = Cita::select('id')->get();
      foreach($citas as $cita){
        $fotos = Cita::where('id',$cita->id)->select('id','foto0','foto1')->get();
        foreach($fotos as $foto){
          $this->Archivo($foto->id,$foto->foto0,'foto0');
          $this->Archivo($foto->id,$foto->foto1,'foto1');
        }
      }
      
      return 'ok';

     
    }

    function Archivo($id,$base64,$carpeta){
        if(strlen(trim($base64))<10)
        return ''; 
        $path="images/citas/".$carpeta;
        $ruta=public_path('/'.$path);
        if(!is_dir($ruta))
            mkdir($ruta, 0777,true);

        if(str_contains($base64,'image/jpeg')){
            $base64=str_replace('data:image/jpeg;base64,','',$base64);
            $nombre= '/'.$id.'.jpg';
        }else if(str_contains($base64,'image/png')){
            $base64=str_replace('data:image/png;base64,','',$base64);
            $nombre= '/'.$id.'.png';
        }
        
        $file = fopen( $ruta.$nombre, 'wb' ); 
        
        if(fwrite( $file, base64_decode($base64) )){
        fclose( $file ); 
        return ($ruta.$nombre);
        }else{
        return '';
        }
    }


    function Pass123(){
      if(!str_contains($_SERVER['HTTP_HOST'],'localhost')){
        redirect('home');
      }
      Director::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);
      
      Administrador::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);

     
      Cliente::where('mail','!=','')
      ->update(['pass' => password_hash(123,PASSWORD_DEFAULT)]);
      

      Asociado::where('mail','!=','')
      ->update(['pass' => (123)]);


      return redirect('home')->with('warning','Se resetearon las contraseñas.');
    }

    function Contratos(){
      $obras=Obra::select('id')->get();
      foreach($obras as $obra){
        if(file_exists('documentos/clientes/contratos/'.$obra->id.'.pdf')){
          Obra::where('id',$obra->id)
          ->update(['contrato' => 1]);
        }
        
      }return'ok';
    }


    function Limite($id_obra){
      return (TieneLimite2($id_obra));
    }
}