<?php

namespace App\Http\Controllers\Asociacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generador;
use App\Models\Entidad;
use Redirect;

class GeneradorController extends Controller
{
    public function __construct(){
        $this->middleware('asociadoislogged');
    }

    public function index(Request $filtros)
    {
        $generadores = Generador::whereraw("razonsocial like '%".$filtros->generador."%'")->paginate(15);
        return view('asociados.generadores.index',['generadores'=>$generadores,'filtros'=>$filtros]);
    }

    public function create()
    {
        $entidades = Entidad::All();
        return view('asociados.generadores.create',['entidades'=>$entidades]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $generador = Generador::findOrFail($id);
        return view('asociados.generadores.show',['generador'=>$generador]);
    }

    public function edit($id)
    {
        $generador = Generador::findOrFail($id);
        return view('asociados.generadores.show',['generador'=>$generador]);
    }

    public function update(Request $request, $id)
    {
        $generador = Generador::findOrFail($id);

        $generador->razonsocial = $request->razonsocial;
        $generador->fisicaomoral = $request->fisicaomoral; // <-- AGREGADO AQUÍ
        $generador->rfc = $request->rfc;

        if(isset($request->rfcpdf)){
            $generador->rfcpdf = $generador->id.'.pdf';
            if(!GuardarArchivos($request->rfcpdf,'/documentos/generadores/rfc/empresa',$generador->rfcpdf)){
                return Redirect::back()->with('error', 'Error al guardar RFC del generador.');
            }
        }

        $generador->calle = $request->calle;
        $generador->numeroext = $request->numeroext;
        $generador->numeroint = $request->numeroint;
        $generador->colonia = $request->colonia;
        $generador->entidad = $request->entidad;
        $generador->municipio = $request->municipio;
        $generador->cp = $request->cp;
        $generador->telefono = $request->telefono;
        $generador->celular = $request->celular;
        $generador->mail = $request->mail;
        $generador->mail2 = $request->mail2;

        if($generador->fisicaomoral=="Moral"){

            $generador->nombresrepre = $request->nombresrepre;
            $generador->apellidosrepre = $request->apellidosrepre;
            $generador->nacionalidadrepre = $request->nacionalidadrepre;
            $generador->identificacionrepre = $request->identificacionrepre;

            if(isset($request->identificacionreprepdf)){
                $generador->identificacionreprepdf = $generador->id.'.pdf';
                if(!GuardarArchivos($request->identificacionreprepdf,'/documentos/generadores/identificaciones/representante',$generador->identificacionreprepdf)){
                    return Redirect::back()->with('error', 'Error al guardar identificación del representante.');
                }
            }

            $generador->rfcrepre = $request->rfcrepre;

            if(isset($request->rfcreprepdf)){
                $generador->rfcreprepdf = $generador->id.'.pdf';
                if(!GuardarArchivos($request->rfcreprepdf,'/documentos/generadores/rfc/representante',$generador->rfcreprepdf)){
                    return Redirect::back()->with('error', 'Error al guardar RFC del representante.');
                }
            }

            $generador->fechaconst = $request->fechaconst ?: null;
            $generador->numeroactacont = $request->numeroactacont;

            if(isset($request->numeroactacontpdf)){
                $generador->numeroactacontpdf = $generador->id.'.pdf';
                if(!GuardarArchivos($request->numeroactacontpdf,'/documentos/generadores/actas/empresa',$generador->numeroactacontpdf)){
                    return Redirect::back()->with('error', 'Error al guardar acta constitutiva.');
                }
            }

            if(isset($request->podernotarial)){
                if(!GuardarArchivos($request->podernotarial,'/documentos/generadores/actas/poder',$generador->id.'.pdf')){
                    return Redirect::back()->with('error', 'Error al guardar el poder notarial del generador.');
                }
            }

            if(isset($request->domicilioempresapdf)){
                $generador->domicilioempresapdf = $generador->id.'.pdf';
                if(!GuardarArchivos($request->domicilioempresapdf,'/documentos/generadores/comprobantedomicilio/empresa',$generador->domicilioempresapdf)){
                    return Redirect::back()->with('error', 'Error al guardar comprobante de domicilio.');
                }
            }

            $generador->notario = $request->notario;
            $generador->numeronotaria = $request->numeronotaria;
            $generador->entidadnotaria = $request->entidadnotaria;
        }

        if($generador->fisicaomoral=="Física"){
            $generador->nombresfisica = $request->nombresfisica;
            $generador->apellidosfisica = $request->apellidosfisica;
            $generador->nacionalidadfisica = $request->nacionalidadfisica;
            $generador->identificacionfisica = $request->identificacionfisica;

            if(isset($request->identificacionfisicapdf)){
                $generador->identificacionfisicapdf = $generador->id.'.pdf';
                if(!GuardarArchivos($request->identificacionfisicapdf,'/documentos/generadores/identificaciones/personafisica',$generador->identificacionfisicapdf)){
                    return Redirect::back()->with('error', 'Error al guardar identificación.');
                }
            }
        }

        if($generador->save()){
            return Redirect::back()->with('success', 'Se guardó correctamente.');
        }else{
            return Redirect::back()->with('error', 'Error al actualizar el registro.');
        }
    }

    public function destroy($id)
    {
        $generador = Generador::findOrFail($id);
        $generador->delete();
        return Redirect::back()->with('success', 'Generador eliminado.');
    }
}