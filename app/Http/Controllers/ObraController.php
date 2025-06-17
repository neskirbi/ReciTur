<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Obra;
use App\Models\TipoObra;
use App\Models\Generador;
use App\Models\Chofer;
use App\Models\CategoriaMaterial;
use App\Models\Material;
use App\Models\MaterialObra;
use App\Models\Planta;
use App\Models\Configuracion;
use Redirect;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('clientelogged');
    }

    public function index()
    {

        $obras = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->where('generadores.id_cliente',Auth::guard('clientes')->user()->id)
        ->select('obras.id','obras.obra','obras.tipoobra','obras.nautorizacion','generadores.razonsocial','obras.verificado','obras.nautorizacion','obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.created_at','obras.aplicaplan')
        ->orderby('obras.created_at','desc')
        ->get();
        

       
        $tipoobras=array();
        return view('cliente.obras.obras',['obras'=>$obras,'tipoobras'=>$tipoobras]);
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

   
    public function store(Request $request)
    {

        $generador=Generador::find($request->generador);
        if(!$generador){
            return Redirect::back()->with('error', 'El generador no se encuentra en los catalogos.');
        }
        $obra=new Obra();

        $obra->id=GetUuid();        
        $obra->id_generador=$generador->id;
        $obra->id_municipio=$request->planta;

        $obra->obra=$request->obra;
        
        
        $obra->tipoobra=json_encode($request->tipoobra);        

        $obra->subtipoobra=json_encode($request->subtipoobra);

        $obra->cantidadobra=$request->cantidadobra;
        $obra->calle=$request->calle;
        $obra->numeroext=$request->numeroext;
        $obra->numeroint=$request->numeroint;
        $obra->colonia=$request->colonia;
        $obra->municipio=$request->municipio;
        $obra->entidad=$request->entidad;
        $obra->cp=$request->cp;
        $obra->latitud=$request->latitud;
        $obra->longitud=$request->longitud;
        $obra->fechainicio=$request->fechainicio;
        $obra->fechafin=$request->fechafin;
        $obra->nautorizacion=isset($request->nautorizacion) ? $request->nautorizacion : '';
        
        $obra->telefono=$request->telefono;
        $obra->celular=$request->celular;
        $obra->correo=$request->correo;
        $obra->correo2=$request->correo2;
        
        if($request->aplicaplan=='on'){
            $obra->aplicaplan=true;
        }else{
            $obra->aplicaplan=false;
        }

        if($request->transporte=='on'){
            $obra->transporte=true;
        }else{
            $obra->transporte=false;
        }

        $confi=Configuracion::select('iva')->where('id_municipio',$request->planta)->first();
        $obra->ivaobra=$confi->iva;
        

        $materiales = DB::table('materiales')
        ->join('categoriasmaterial','categoriasmaterial.id','=','materiales.id_categoriamaterial')
        ->select('categoriasmaterial.categoriamaterial','materiales.id','materiales.material','materiales.precio')
        ->where('categoriasmaterial.id_municipio',$request->planta)
        ->get();
        
        
        if(!$materiales){
            return Redirect::back()->with('error', 'El los materiales no se encuentra en los catalogos.');
        }

        $obra->superficie=$request->superficie;
        $obra->superunidades=$request->superunidades;
        $acumulado="";

        for($i=0;$i<count($materiales);$i++){
            $materialesobra=new MaterialObra();
            $materialesobra->id=GetUuid();
            $materialesobra->id_obra=$obra->id;
            $materialesobra->categoriamaterial=$materiales[$i]->categoriamaterial;
            $materialesobra->id_material=$materiales[$i]->id;
            $materialesobra->material=$materiales[$i]->material;
            $materialesobra->precio=$materiales[$i]->precio;
            
            
            foreach($request->material as $index => $mate)
            {
                if($mate==$materiales[$i]->id)
                {                    
                    $materialesobra->cantidad=$request->cantidad[$index];
                    break;
                }else{
                    
                    $materialesobra->cantidad=0;
                }
            }
            
            $materialesobra->unidades=$request->superunidades;
            if(!$materialesobra->save()){
                return Redirect::back()->with('error', 'Error al guardar los materiales.');
            }
        }
        $correos=['emiliano@csmx.mx','ventas@csmx.mx'];
        if($request->planta=='0e8332117ef04888838b4037b7e99ee3'){
            $correos=['emiliano@csmx.mx','ventas@csmx.mx'];
        }else if($request->planta=='2bbe5acbd4894dfea786416d22da3875'){
            
            $correos=['morganfloresmichel@gmail.com'];
        }

        if($obra->save()){
            Notificar('Nueva Obra','Obra registrada.','Verificar datos de la obra.','Se registró la obra '.$obra->obra.' de '.$generador->razonsocial.', favor de verificar la información.',$correos,'<a href="https://reci-trash.mx" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return view('mails.obraregistrada');
        }else{
            return redirect('obras')->with('error', 'Error al guardar la obra.');
        }
        
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obra=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('obras.id',$id)
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->first();

        $obra->tipoobra=json_decode($obra->tipoobra);        

        $obra->subtipoobra=json_decode($obra->subtipoobra);

        $tipoobras=TipoObra::select('tipoobra',DB::raw("group_concat(id,'::',subtipoobra SEPARATOR ';;') as subtipoobra"))->groupby('tipoobra')->get();
        $materiales=DB::table('obras')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$id)
        ->where('materialesobra.cantidad','!=',0)
        ->select('materialesobra.categoriamaterial','materialesobra.material','materialesobra.cantidad','materialesobra.unidades','materialesobra.precio','materialesobra.cantidad')
        ->get();

        $planta=Planta::find($obra->id_municipio);


        if(!$obra){
            return redirect('obras')->with('error', 'No existen datos.');
        }
        return view('cliente.obras.obra',['obra'=>$obra,'materiales'=>$materiales,'tipoobras'=>$tipoobras,
        'planta'=>$planta,'tag'=>(isset($tag->tag) ? $tag->tag : 'Cantidad')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::guard('clientes')->check()) {
            return Redirect::back()->with('error', 'Error de sesión.');
        }

        $obra=Obra::where('id',$id)->where('verificado',0);
        
        if (!$obra) {
            return Redirect::back()->with('error', 'Error al borrar, obra verificada.');
        }

        if($obra->delete()){
            return Redirect::back()->with('success', 'Obra eliminada.');
        }

        return Redirect::back()->with('error', 'Error al eliminar.');
    }

    public function viewobra(Request $request)
    {
        $obra=Obra::find($request->id);
        return view('cliente.obras.obra',['obra'=>$obra]);
    }

    /**
     * CArga los datos y regresa la vista para el registro de obras
     */

    public function RegistroObra(){
        $generadores = Generador::all()
        ->where('id_cliente',Auth::guard('clientes')->user()->id)
        ->where('verificado','1');
        

        $tipoobras=TipoObra::select('tipoobra',DB::raw("group_concat(id,'::',subtipoobra SEPARATOR ';;') as subtipoobra"))->groupby('tipoobra')->get();
 
        $configuraciones=DB::table('configuraciones')->first();
        $iva=$configuraciones->iva;

       
        
        $categorias=CategoriaMaterial::orderby('categoriamaterial','asc')->get();
        $materiales=Material::all();
        $plantas=Planta::where('tipo',1)->get();
        return view('cliente.obras.registroobra',['generadores'=>$generadores,'tipoobras'=>$tipoobras,
        'categorias'=>$categorias,'materiales'=>$materiales,'iva'=>$iva,'plantas'=>$plantas]);
    }

    public function CargarPlan(Request $request,$id){


        $declaratoria = $id.'.pdf';

        if(!GuardarArchivos($request->declaratoria,'/documentos/obras/declaratoria',$declaratoria)){
            return Redirect::back()->with('error', 'Error al guardar declaratoria.');
        }

        $plan = $id.'.pdf';

        if(!GuardarArchivos($request->planmanejo,'/documentos/obras/plan',$plan)){
            return Redirect::back()->with('error', 'Error al guardar plan de manejo.');
        }
        $obra=Obra::find($id);
        $obra->nautorizacion=$request->nautorizacion;
        $obra->vigenciaplan=$request->vigenciaplan;
        $obra->declaratoria=$declaratoria;
        $obra->planmanejo=$plan;
        if($obra->save()){
            return Redirect::back()->with('success', 'Plan de manejo guardado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar plan de manejo.');
        }
    
    }


    public function ReporteObra($id)
    {      

        $obras= DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('obras.id',$id)
        ->select('obras.id','obras.obra','obras.superficie','obras.superunidades','obras.tipoobra','obras.calle','obras.numeroext','obras.numeroint','obras.colonia','obras.municipio','obras.entidad','obras.fechainicio','obras.fechafin','obras.nautorizacion')
        ->orderby('obras.obra','asc')
        ->get();
        
        $materialesobra=DB::table('citas')
        ->join('materialesobra','citas.id_materialobra','=','materialesobra.id')
        ->where('citas.id_obra','=',$id)
        ->where('citas.confirmacion','=',1)
        ->select('materialesobra.id','materialesobra.material','materialesobra.cantidad as volumen','materialesobra.unidades','citas.cantidad','citas.fechacita')
        ->orderby('cantidad','desc')
        ->get();

        $acumulados=DB::table('citas')
        ->join('materialesobra','citas.id_materialobra','=','materialesobra.id')
        ->where('citas.id_obra','=',$id)
        ->where('citas.confirmacion','=',1)
        ->select('materialesobra.material','materialesobra.unidades','materialesobra.cantidad as volumen',DB::raw('sum(citas.cantidad) as cantidad'),DB::raw('count(citas.cantidad) as nentregas'))
        ->groupby('materialesobra.material','volumen','materialesobra.unidades')
        ->orderby('cantidad','desc')
        ->get(); 
        /**
         * Se calcula las emiciones de CO2  7Kg por cada 1m3
         */
        $total=0;
        foreach($materialesobra as $materialobra){
            $total+=($materialobra->cantidad*1);
        }  
        $total=$total*7;      

        return view('formatos.clientes.reporte',['obras'=>$obras,'materialesobra'=>$materialesobra,'total'=>$total,'acumulados'=>$acumulados]);

        /*$pdf = \PDF::loadView('formatos.sedema.reporte',['obras'=>$obras,'materialesobra'=>$materialesobra]);

        return $pdf->setPaper('Legal', 'portrait')->download('Reporte.pdf');*/
    }
}
