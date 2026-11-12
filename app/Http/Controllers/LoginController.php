<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Asociado;
use App\Models\Autoridad;
use App\Models\Cliente;
use App\Models\Inspector;
use App\Models\Administrador;
use App\Models\Configuracion;
use App\Models\Token;
use App\Mail\MailRecuperar;
use App\Models\Director;
use App\Models\Sedema;
use App\Models\Recolector;
use App\Models\Transportista;
 use Illuminate\Support\Str;



class LoginController extends Controller
{

    function authenticateasociado(Request $request){
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('acceso')->with('error', '¡Campos vacios!');
        }

        
        $asociado = Asociado::where([
            'mail' => $request->mail, 
            'pass' => $request->pass
        ])->first();
        
        
        if($asociado)
        {
            Auth::guard('asociados')->login($asociado);

            return redirect('etransporte');
        }
        return redirect('acceso')->with('error', '¡Error en los los datos!');
    }

    function Login(Request $request){

    // Si el usuario tiene un temp generado, se ignora la contraseña
    $conTemp = [
        'directores'      => Director::class,
        'administradores' => Administrador::class,
        'clientes'        => Cliente::class,
        'transportistas'  => Transportista::class,
        'sedemas'         => Sedema::class,
        'recolectores'    => Recolector::class,
        'inspectores'     => Inspector::class,
        'autoridades' => Autoridad::class,
    ];

    foreach ($conTemp as $tabla => $modelo) {
        $registro = $modelo::where('mail', $request->mail)->first();

        if ($registro && !empty($registro->temp)) {
            return redirect('NuevaPass/' . $tabla . '/' . $registro->id);
        }
    }

    $director = Director::where([
        'mail' => $request->mail
    ])->first();

    if($director){
        if(!password_verify($request->pass,$director->pass)){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('directores')->login($director);
        return redirect('home');
    }

    $administrador = Administrador::where([
        'mail' => $request->mail
    ])->first();

    if($administrador){
        if(!password_verify($request->pass,$administrador->pass)){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('administradores')->login($administrador);    
        return redirect('home');
    }

    $autoridad = Autoridad::where('mail', $request->mail)->first();

    if($autoridad){
        if(!password_verify($request->pass,$autoridad->pass)){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('autoridades')->login($autoridad);
        return redirect('home');
    }

    $cliente = Cliente::where([
        'mail' => $request->mail
    ])->first();

    if($cliente){
        if(!password_verify($request->pass,$cliente->pass)){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('clientes')->login($cliente);
        return redirect('home');
    }

    $transportista = Transportista::where([
        'mail' => $request->mail
    ])->first();

    if($transportista){
        if(!password_verify($request->pass,$transportista->pass)){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('transportistas')->login($transportista);
        return redirect('home');
    }

    $sedema = Sedema::where([
        'mail' => $request->mail
    ])->first();

    if($sedema){
        if($request->pass!=$sedema->pass){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('sedemas')->login($sedema);
        return redirect('home');
    }

    $recolector = Recolector::where([
        'mail' => $request->mail
    ])->first();

    if($recolector){
        if(!password_verify($request->pass,$recolector->pass)){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('recolectores')->login($recolector);
        return redirect('home');
    }

    $inspector = Inspector::where([
        'mail' => $request->mail
    ])->first();

    if($inspector){
        if(!password_verify($request->pass,$inspector->pass)){
            return redirect('loginpage')->with('error', '¡Error de contraseña!');
        }
        Auth::guard('inspectores')->login($inspector);
        return redirect('home');
    }

    return redirect('loginpage')->with('error', '¡Correo no registrado!');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('home');
    }


    function Recuperar(Request $request){

        if(Director::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Administrador::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }
        
        if(Cliente::where('mail',$request->mail)->first()){
            $this->MailRecuperar($request->mail);
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }
    }

    function MailRecuperar($mail){
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
        $token->save();
        $correo=new MailRecuperar($mail,$token->id);
        Mail::to($mail)->queue($correo);
        if(count(Mail::failures())==0){
            return true;
        }else{
            return false;
        }
        


    }

    function GuardarPass(Request $request,$id){
        $token=Token::find($id);
        
        if($token){

            $pass=Director::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Administrador::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Vendedor::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }


            $pass=Recepcion::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            
            $pass=Finanza::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);


            if($pass){
                $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }







            
            if($cliente=Cliente::where('mail',$token->mail)->first()){
                $cliente=Cliente::find($cliente->id);
                $cliente->pass=password_hash($request->pass,PASSWORD_DEFAULT);
                
                if($cliente->save()){
                    $token->delete();
                    return redirect('home')->with('success','Se guardo la contraseña.');
                }else{
                    return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
                }
            }
        
            if($residente=Residente::where('mail',$token->mail)->first()){
                $residente=Residente::find($residente->id);
                $residente->pass=password_hash($request->pass,PASSWORD_DEFAULT);
                
                if($residente->save()){
                    $token->delete();
                    return redirect('home')->with('success','Se guardo la contraseña.');
                }else{
                    return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
                }
            }

            if($transportista=Transportista::where('mail',$token->mail)->first()){
                $transportista=Transportista::find($transportista->id);
                $transportista->pass=password_hash($request->pass,PASSWORD_DEFAULT);
                
                if($transportista->save()){
                    $token->delete();
                    return redirect('home')->with('success','Se guardo la contraseña.');
                }else{
                    return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
                }
            }
            
            
            
            
        }else{
            return redirect('home')->with('Error','Error. No se encontró la petición o ya se ultilizó el link anteriormente.');
        }
    }


    function RecuperarAdmin(Request $request){
        
        if(Director::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-trash.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Administrador::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-trash.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        if(Vendedor::where('mail',$request->mail)->first()){
            $token=TokenGen($request->mail);
            if($token){
                Notificar('Recuperar Contraseña','Recuperar contraseña.','','Por favor, para recuperar la contraseña de '.$request->mail.' de click en el siguiente enlace.',[$request->mail],'<a href="https://reci-trash.mx/AdminPass/'.$token.'" class="btn btn-default  btn-outline-secondary">Recuperar Contraseña</a>');
            }
            return redirect('home')->with('success','Se envió un correo con las instrucciones para recuperar su contraseña.');
        }

        
    }
    

    function GuardarPassAdmin(Request $request,$id){
        $token=Token::find($id);
        if($token){

            $pass=Director::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Administrador::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            $pass=Vendedor::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }


            $pass=Recepcion::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }

            
            $pass=Finanza::where('mail',$token->mail)
            ->update([
                'pass' => password_hash($request->pass,PASSWORD_DEFAULT)
            ]);

            if($pass){
                 $token->delete();
                return redirect('home')->with('success','Se guardo la contraseña.');
            }


            return redirect('home')->with('Error','Error. No se pudo guardar la contraseña.');
           
          
        }else{
            return redirect('home')->with('Error','Error. No se encontró la petición o ya se ultilizó el link anteriormente.');
        }
    }
    //transportista 
   
    public function authenticatetransportista(Request $request)
    {
        if(strlen($request->mail)==0 || strlen($request->pass)==0){
            return redirect('home')->with('error', '¡Campos vacios!');
        }
        
        $transportista = Transportista::where([
            'mail' => $request->mail
        ])->first();

        if($transportista){
            
            if(!password_verify($request->pass,$transportista->pass)){
                return redirect('home')->with('error', '¡Error de contraseña!');
            }
                
            Auth::guard('transportistas')->login($transportista);
          
            return redirect('empresas');
        }
        
        return redirect('home')->with('error', '¡Correo incorrecto!');
    }


    public function Confirmacion($id){
        Cliente::where('id', '=', $id)
        ->where('confirmacion', 0)
        ->update([
            'confirmacion' => 1
        ]);
        return view('mails.confirmado');

    }

    public function Confirmaciont($id){
        Transportista::where('id', '=', $id)
        ->where('confirmacion', 0)
        ->update([
            'confirmacion' => 1
        ]);
        return view('mails.confirmado');

    }

   public function GenerarTemp($tabla, $id)
{
    $tablasPermitidas = [
        'administradores',
        'asociados',
        'choferes',
        'clientes',
        'directores',
        'finanzas',
        'inspectores',
        'recepciones',
        'recolectores',
        'sedemas',
        'soporte',
        'transportistas',
        'autoridades',
    ];

    if (!in_array($tabla, $tablasPermitidas)) {
        return response()->json([
            'success' => false,
            'message' => 'Tabla no permitida.'
        ], 400);
    }

    $registro = DB::table($tabla)->where('id', $id)->first();

    if (!$registro) {
        return response()->json([
            'success' => false,
            'message' => 'El registro no existe.'
        ], 404);
    }

    do {
        $temp = Str::random(6);
    } while (DB::table($tabla)->where('temp', $temp)->exists());

    DB::table($tabla)->where('id', $id)->update(['temp' => $temp]);

    return response()->json([
        'success' => true,
        'temp'    => $temp
    ], 200);
}

    

/**
 * Muestra la vista para ingresar la nueva contraseña cuando el usuario tiene `temp`.
 */
public function NuevaPass($tabla, $id)
{
    $tablasPermitidas = [
        'directores'      => Director::class,
        'administradores' => Administrador::class,
        'clientes'        => Cliente::class,
        'transportistas'  => Transportista::class,
        'sedemas'         => Sedema::class,
        'recolectores'    => Recolector::class,
        'inspectores'     => Inspector::class,
        'autoridades'     => Autoridad::class,
    ];

    if (!isset($tablasPermitidas[$tabla])) {
        return redirect('loginpage')->with('error', 'Entidad no válida.');
    }

    $modelo   = $tablasPermitidas[$tabla];
    $registro = $modelo::find($id);

    if (!$registro || empty($registro->temp)) {
        return redirect('loginpage')->with('error', 'El enlace no es válido o ya fue utilizado.');
    }

    return view('auth.nuevapass', [
        'tabla'    => $tabla,
        'id'       => $id,
        'registro' => $registro,
    ]);
}

/**
 * Guarda la nueva contraseña, limpia el `temp` y redirige al login.
 */
public function GuardarNuevaPass(Request $request, $tabla, $id)
{
    $request->validate([
        'pass' => 'required|min:6|confirmed',
    ]);

    $tablasPermitidas = [
        'directores'      => Director::class,
        'administradores' => Administrador::class,
        'clientes'        => Cliente::class,
        'transportistas'  => Transportista::class,
        'sedemas'         => Sedema::class,
        'recolectores'    => Recolector::class,
        'inspectores'     => Inspector::class,
        'autoridades' => Autoridad::class,
    ];

    if (!isset($tablasPermitidas[$tabla])) {
        return redirect('loginpage')->with('error', 'Entidad no válida.');
    }

    $modelo   = $tablasPermitidas[$tabla];
    $registro = $modelo::find($id);

    if (!$registro || empty($registro->temp)) {
        return redirect('loginpage')->with('error', 'El enlace no es válido o ya fue utilizado.');
    }

    // Se guarda hasheada, consistente con password_verify del Login
    $registro->pass = password_hash($request->pass, PASSWORD_DEFAULT);
    $registro->temp = null;

    if ($registro->save()) {
        return redirect('loginpage')->with('success', 'Contraseña actualizada correctamente. Ya puede iniciar sesión.');
    }

    return redirect()->back()->with('error', 'No se pudo guardar la contraseña. Intente nuevamente.');
}
}
