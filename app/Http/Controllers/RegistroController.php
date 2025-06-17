<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Transportista;
use Redirect;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Registro(Request $request)
    {
        

         //return $request;
         if(strlen($request->mail)==0 || strlen($request->pass)==0 || strlen($request->nombres)==0 || strlen($request->apellidos)==0){
            return redirect('home')->with('error', '¡Datos incorrectos!');
        }


        if($request->pass!=$request->pass2){
            return Redirect::back()->with('error', 'Error al crear el registro, las contraseñas no coinciden.');
        }
          
        
        $cliente = Cliente::where([
            'mail' => $request->mail
        ])->first();
        
        if($cliente)
        {
            return Redirect::back()->with('error', 'Error al registrar, el correo ya se ha registrado anteriormente.');
        }

       
        $cliente=new Cliente();
        $id = $cliente->id = GetUuid();
        $cliente->nombres=$request->nombres;
        $cliente->apellidos=$request->apellidos;
        $mail = $cliente->mail=$request->mail;
        $cliente->pass=password_hash($request->pass,PASSWORD_DEFAULT);
        $cliente->accept= $request->accept=='on' ? 1 : 0;
        if($cliente->save()){
            return view('mails.enviodecorreo',['cliente'=>$cliente]);
        }else{
            return Redirect::back()->with('error', 'Error al crear el registro.');
        }
        
        
        
    }

   
}
