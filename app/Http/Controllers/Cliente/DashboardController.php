<?php

namespace App\Http\Controllers\Cliente;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\Planta;
use Redirect;

class DashboardController extends Controller
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

        $generadores=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->where('clientes.id','=',Auth::guard('clientes')->user()->id)
        ->select('generadores.id','razonsocial')->get();
        

        $pagodetalles = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->select('pagos.id','pagos.monto','pagos.referencia','pagos.status','pagos.descripcion','pagos.created_at','pagos.detalle')
        ->orderby('pagos.created_at','desc')
        ->get();

        
        
        
        $pago = Pago(Auth::guard('clientes')->user()->id);
        
        $gasto=0;
        

        $saldo=$pago;

        $id_municipios=array();

        $compenzado=0;
       

        $plantas=Planta::wherein('id',$id_municipios)->orderby('planta','asc')->get();

        return view('cliente.dashboard.dashboard',['generadores'=>$generadores,
        'saldo'=>$saldo,
        'pagodetalles'=>$pagodetalles,
        'pago'=>$pago,
        'gasto'=>$gasto,
        'compenzado'=>$compenzado,
        'plantas'=>$plantas]);
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
        //
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
        //
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

    function GraficasPagosCliente(Request $request){
        
        $year = isset($request->year) ? $request->year : date('Y');

        $pagos = DB::table('clientes')
        ->leftjoin('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->where('pagos.status',2)
        ->whereraw('YEAR(pagos.created_at) = \''.$year.'\'')
        ->select(DB::raw('YEAR(pagos.created_at) year, MONTH(pagos.created_at) month'), DB::raw('SUM(pagos.monto) as monto'))
        ->groupby('year','month')
        ->get();

        $gastos=0;

        $pedidos=0;

        return view('cliente.dashboard.frames.graficapagos',[
        'filtros'=>$request,
        'pagos'=>$pagos,
        'pedidos'=>$pedidos,
        'gastos'=>$gastos]);

    }
}
