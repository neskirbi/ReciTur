<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\MaterialObra;
use App\Models\Material;
use App\Models\Cliente;
use App\Models\Planta;
use App\Models\CondicionMaterial;
use App\Models\Configuracion;
use App\Models\Obra;
use App\Models\Administrador;
use Redirect;

class CitasFechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filtros)
    {
        //return $filtros;
        /**
         * Demonio para verificar pasadas.
         */
        Cita::whereRaw('DATEDIFF(NOW(),fechacita)>0')
        ->where('confirmacion', 0)
        ->update([
            'confirmacion' => 2
        ]);

        $citas_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_municipio','=',GetIdPlanta())
        ->where('citas.borrado',1)
        ->count();

        $citas_pendientes_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_municipio','=',GetIdPlanta())
            ->where('citas.borrado',1)
                ->where('citas.confirmacion',0)
                    ->count();

        $citas_asistidas_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_municipio','=',GetIdPlanta())
            ->where('citas.borrado',1)
                ->where('citas.confirmacion',1)
                    ->count();

        $citas_falta_count = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_municipio','=',GetIdPlanta())
            ->where('citas.borrado',1)
                ->where('citas.confirmacion',2)
                    ->count();

        $citas = DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('obras.id_municipio','=',GetIdPlanta())
        ->where('obras.obra','like','%'.$filtros->obra.'%')
        ->orderBy('citas.folio', 'asc')
        ->select('citas.id','citas.obra',DB::raw("'Reciclaje' as tipo"),'citas.fechacita','citas.planta','citas.confirmacion','citas.folio','citas.matricula')
        ->paginate(10);


        return view('administracion.citasfecha.citas',['citas'=>$citas,
        'citas_count'=>$citas_count,
        'citas_pendientes_count'=>$citas_pendientes_count,
        'citas_asistidas_count'=>$citas_asistidas_count,
        'citas_falta_count'=>$citas_falta_count,'filtros'=>$filtros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cita = DB::table('citas')
        ->where('id', $id)
        ->first();
        $materialesobra=DB::table('materialesobra')
        ->orderBy('material', 'asc')
        ->where('id_obra','=',$cita->id_obra)
        ->get();
        $materialobra=MaterialObra::find($cita->id_materialobra);
        //return view('formatos.cita', ['data'=>$cita]);

        $cita->fechacita=str_replace("-","/",date('Y-m-d',strtotime($cita->fechacita)));
        $cita->qr=$id.'.png';
        
        $qrimage= ('images/qr/boleta/'.$cita->qr);
        \QRCode::text('reci-trash.mx/boleta/'.$id)->setOutfile($qrimage)->png(); 

        return view('administracion.citas.citarev', ['cita'=>$cita,'materialobra'=>$materialobra,'materialesobra'=>$materialesobra]);
    
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        //return $request;
        $administrador=Administrador::find(GetId());
        $cita=Cita::find($id);
        $cita->recibio=$administrador->administrador;
        $cita->firmarecibio=$administrador->firma;
        $cita->cargo=$administrador->cargo;

        /**
         * Busco en los materiales de la obra para cmbiarlo, si no lo registraron se va a gregar a la obra
         */
        if($request->material!=null){
            $materialobra=DB::table('materialesobra')
            ->where('id_obra','=',$cita->id_obra)
            ->where('id_material',$request->material)->first();
        
            if($materialobra){
                /**
                 * Se actualiza el material en la cita si es que ya esta como material de obra, si no lo busca para agregarlo abajo en el else
                 */
                
                $cita->id_materialobra=$materialobra->id;
                $cita->material=$materialobra->material;
                $cita->precio=$materialobra->precio;
                
            }
        }        

        
        $cita->cantidad=$request->cantidad;
        $cita->observacion=$request->observacion;
        if(strlen($cita->recibio)==0){
            $cita->recibio=GetNombre();
        }
        if(strlen($cita->cargo)==0){
            $cita->cargo=GetCargo();
        }


        $obra=Obra::find($cita->id_obra);

        if($cita->confirmacion==0 || $cita->folio==0){
            $configuracion=Configuracion::where('id_municipio','=',$obra->id_municipio)->first();
            $configuracion->folio=$configuracion->folio+1;
            $cita->folio=$configuracion->folio;
            $configuracion->save();
        }
        

        $cita->confirmacion=1;
        
        
        if($cita->save()){
            Historial('citas',$cita->id,GetId(),'Confirmación de Cita','');
            return Redirect::back()->with('success', 'Cita confirmada.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }





   
    
}
