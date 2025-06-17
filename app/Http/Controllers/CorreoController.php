<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionMail;
use App\Models\Cliente;
use App\Models\Generador;

class CorreoController extends Controller
{

    /**
     * Envia correo al cliente que se da de alta
     */
    public function CorreoConfirmApi(Request $request){
        
        $cliente=Cliente::find($request->id);
        if($cliente){
            if($cliente->confirmacion==1){
                return '{"error":"El usuario ya ha sido confirmado","failures":""}';
            }
            $correo=new ConfirmacionMail($cliente);
            Mail::to($cliente->mail)->queue($correo);
            if(count(Mail::failures())==0){
                return '{"success":"Se envio el correo"}';
            }else{
                return '{"error":"No se pudo enviar el correo","failures":"'.Mail::failures().'"}';
            }
        }else{
            return '{"error":"No se encuentra al cliente","failures":""}';
        }
        


    }



  
}
