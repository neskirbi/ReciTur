<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recoleccion;
use App\Models\Vehiculo;
use App\Models\Planta;
use App\Models\Configuracion;
use App\Models\Recolector;
use App\Models\EmpresaTransporte;
use Redirect;


class RecoleccionController extends Controller
{
    

    public function __construct(){
        $this->middleware('administradorlogged');
    }

    function index(){
       $recolecciones=Recoleccion::select('recolecciones.id','negocios.negocio','recolecciones.cantidad','negocios.tiponegocio',
       'recolecciones.created_at','recolecciones.matriculat',
        DB::RAW("(select contenedor from contenedores where opcion=recolecciones.contenedor) as contenedor"),
        DB::RAW("(select residuo from residuos where opcion=recolecciones.residuo) as residuo"),
        DB::RAW("(select plantaauto from plantas where id=recolecciones.id_municipio) as plantaauto"))
        ->join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->where('recolecciones.id_municipio',GetIdMunicipio())
        ->orderby('created_at','desc')
        ->paginate(15);
        return view('administracion.recolecciones.index',['recolecciones'=>$recolecciones]);
    }


    function show($id){
        
        $recoleccion = Recoleccion::select('id',
            DB::RAW("(select recolector from recolectores where id=recolecciones.id_recolector) as responsable")
        )
        ->where('id',$id)->first();
        //$vehiculos=Vehiculo::where('id_municipio',GetIdMunicipio())->get();
        return view('administracion.recolecciones.show',['recoleccion'=>$recoleccion]);

    }

    function update(Request $request,$id){
        $vehiculo=Vehiculo::find($request->id_vehiculo);
        $empresa=EmpresaTransporte::find($vehiculo->id_empresa);
        $recoleccion = Recoleccion::find($id);
       
        
        
        $planta=Planta::find(GetIdMunicipio());
        $configuracion=Configuracion::where('id_municipio',GetIdMunicipio())->first();
        $recolector=Recolector::find($recoleccion->id_recolector);

        if($configuracion->firma_repre==''){
            return redirect('recoleccion/'.$id)->with('error','Primero debe configurar los datos del representante legal.');
        }


        $recoleccion->vehiculo = $vehiculo->vehiculo;
        $recoleccion->matriculat = $vehiculo->matricula;


        $recoleccion->transportista=$empresa->razonsocial;
        $recoleccion->domiciliot=$empresa->domicilio;
        $recoleccion->ramir=$empresa->ramir;
        $recoleccion->telefonot=$empresa->telefono;
        $recoleccion->sctt=$empresa->regsct;

        $recoleccion->recolector=$recolector->recolector;
        $recoleccion->firmat=isset($recolector->firma) ? $recolector->firma : '' ;
        $recoleccion->ruta=$configuracion->ruta;

        $recoleccion->empresar=$planta->planta;
        $recoleccion->ramirr=$planta->plantaauto;
        $recoleccion->domicilior=$planta->direccion;
        $recoleccion->telefonor=$configuracion->telefono;
        $recoleccion->nombrer=$configuracion->representante;
        $recoleccion->firmar=$configuracion->firma_repre;
        $recoleccion->cargor=$configuracion->cargo;



        $recoleccion->save();

        return redirect('recoleccion')->with('success','Se guardó la información.');

    }
}
