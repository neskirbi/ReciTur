<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\Administracion\RecoleccionesExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Recoleccion;
use App\Models\Vehiculo;
use App\Models\Planta;
use App\Models\Configuracion;
use App\Models\Recolector;
use App\Models\EmpresaTransporte;
use App\Models\Generador;
use Redirect;


class RecoleccionController extends Controller
{
    

    public function __construct(){
        $this->middleware('administradorlogged');
    }

    function index(){
      $recolecciones=Recoleccion::select('negocios.negocio','negocios.giro','recolecciones.id','recolecciones.created_at')
      ->join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->orderby('recolecciones.created_at','desc')
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

    function ReporteRecolecciones($FechaIni,$FechaFin){
        /*
        return $negocios = Generador::join('negocios','negocios.id_generador','=','generadores.id')
        ->join('recolecciones','recolecciones.id_negocio','=','negocios.id')
        ->select('generadores.razonsocial','negocios.negocio as estableciomiento','negocios.clasificacion','recolecciones.created_at',
        DB::RAW("(select sum(cantidad) from recoleccion where id_recoleccion = recolecciones.id) as cantidad"))
        ->WhereRaw("recolecciones.created_at >='".$FechaIni."' and recolecciones.created_at <='".$FechaFin."' ")
        ->get();
        */

        $recolecciones = Generador::join('negocios', 'negocios.id_generador', '=', 'generadores.id')
        ->join('recolecciones', 'recolecciones.id_negocio', '=', 'negocios.id')
        ->select(
            'generadores.razonsocial as GENERADOR',
            'negocios.negocio as ESTABLECIMIENTO', 
            'negocios.clasificacion as CLASIFICACION',
            'recolecciones.created_at as FECHA_DE_RECOLECCION',
            DB::RAW("(select sum(cantidad) from recoleccion where id_recoleccion = recolecciones.id) as CANTIDAD")
        )
        ->whereBetween('recolecciones.created_at', [$FechaIni, $FechaFin])
        ->orderBy('recolecciones.created_at', 'desc')
        ->get();

        //$recolecciones = $this->ReporteRecolecciones($FechaIni, $FechaFin);
    
        return Excel::download(
            new RecoleccionesExport($recolecciones), 
            'reporte_recolecciones_' . $FechaIni . '_al_' . $FechaFin . '.xlsx'
        );

    }
}
