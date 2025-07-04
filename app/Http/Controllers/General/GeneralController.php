<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Administrador;
use App\Models\Planta;
use App\Models\Recoleccion;
use App\Models\Configuracion;


class GeneralController extends Controller
{
    function Manifiesto($id){

        $recoleccion=Recoleccion::select('recolecciones.id','recolecciones.folio',
        'recolectores.nombres','recolectores.apellidos',
        'negocios.negocio',
        'generadores.id_cliente','generadores.razonsocial','generadores.fisicaomoral','generadores.telefono','generadores.calle','generadores.numeroext','generadores.numeroint','generadores.colonia','generadores.municipio','generadores.cp','generadores.entidad')
        ->join('recolectores','recolectores.id','=','recolecciones.id_recolector')    
        ->join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->join('generadores','generadores.id','=','negocios.id_generador')
        ->join('clientes','clientes.id','=','generadores.id_cliente')
        ->where('recolecciones.id',$id)
        ->orderby('recolecciones.created_at','desc')
        ->first();

        // Obtener los detalles de recolección por separado
        $detallesRecoleccion = DB::table('recoleccion')
        ->select('recoleccion.residuo','recoleccion.cantidad','recoleccion.subtotal','recoleccion.unidades')
        ->where('id_recoleccion', $recoleccion->id)
        ->get();
        

        $planta = array();
        $configuracion = array();

        $administrador = array();
        //return view('formatos.recolecciones.manifiesto',['recoleccion'=>$recoleccion,'configuracion'=>$configuracion,'planta'=>$planta,'administrador'=>$administrador]);
        $pdf = \PDF::loadView('formatos.recolecciones.manifiesto',['recoleccion'=>$recoleccion,'configuracion'=>$configuracion,'planta'=>$planta,'administrador'=>$administrador,'detallesRecoleccion'=>$detallesRecoleccion]);
        
        return $pdf ->setPaper('A4', 'portrait')->download($recoleccion->negocio.'.pdf');
    }

    /**
     * 
     * select('citas.obra','citas.folio','generadores.razonsocial',
        'generadores.fisicaomoral','generadores.telefono','generadores.calle',
        'generadores.numeroext','generadores.numeroint','generadores.colonia',
        'generadores.municipio','generadores.cp','obras.cantidadobra',
        'obras.telefono as obrtelefono','citas.calleynumeroobr as obrcalle','citas.nautorizacion','obras.cancelado',
        'citas.coloniaobr as obrcolonia','citas.municipioobr as obrmunicipio','citas.cpobr as obrcp','obras.tipoobra',
        'obras.superficie','citas.distancia',
        'citas.nautorizacion','obras.numeroint as obrnumeroint',
        'citas.foliofiscal',
        'citas.id_materialobra','citas.nombrecompleto','citas.observacion','citas.fechacita',
        'citas.unidades','citas.combustible','citas.id_obra',
        'citas.cantidad','citas.razonvehiculo','citas.direccionvehiculo','citas.telefonovehiculo',
        'citas.ramir','citas.regsct','citas.vehiculo','citas.marcaymodelo','citas.matricula',
        'citas.condicionesmaterial','citas.planta','citas.plantaauto','citas.direccionplanta',
        'citas.nombreres','citas.firmares','citas.nombrecompleto','citas.firmachof','citas.recibio',
        'citas.cargo','citas.firmarecibio','citas.confirmacion')
     */
}
