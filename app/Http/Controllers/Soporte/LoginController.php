<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Soporte;
use Redirect;

class LoginController extends Controller
{
    function LoginSoporte(Request $request){
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('soporte')->with('error', '¡Campos vacios!');
        }

        
        $soporte = Soporte::where([
            'mail' => $request->mail, 
            'pass' => $request->pass
        ])->first();
        
        
        if($soporte){
            Auth::guard('soporte')->login($soporte);

            return redirect('vehiculossoporte');
        }
        return redirect('soporte')->with('error', '¡Error en los los datos!');
    }

}
