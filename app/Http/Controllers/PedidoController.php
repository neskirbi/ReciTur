<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductoObra;
use App\Models\Carrito;
use App\Models\Configuracion;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Obra;
use Redirect;


class PedidoController extends Controller
{
    function index(){    
        
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
        $cart = DetallePedido::where('id_usuario',$id_usuario)->get()->where('carrito',1)->count();
        if(Auth::guard('clientes')->check()){
            //$productos=Pedido::where('id_usuario',$id_usuario)->orderby('created_at','desc')->paginate(10);
            
            $productos = DB::table('clientes')            
            ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->join('pedidos', 'pedidos.id_obra', '=', 'obras.id')
            ->select('pedidos.id','pedidos.obra','pedidos.subtotal','pedidos.total','pedidos.created_at','pedidos.confirmacion','pedidos.created_at','pedidos.fechaentrega')
            ->where('clientes.id',$id_usuario)            
            ->where('obras.verificado',1)     
            ->paginate(10);
        }  
        if(Auth::guard('residentes')->check()){
            $productos=Pedido::where('id_usuario',$id_usuario)->orderby('created_at','desc')->paginate(10);
        }
        
        return view('generales.pedidos.pedidos',['productos'=>$productos,'cart'=>$cart]);
    }

    function store(Request $request){
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
        
        $id_obra='';
        $subtotal=0;

        /**
         * Prepara los registros  de el carrito para actualizar y generar el pedido
         */
        $arraydetallepedido=array();
        foreach($request->id as $i=>$id){
            $detallepedido=DetallePedido::where('id',$id)->where('carrito',1)->first();
            if($detallepedido){
                $detallepedido->cantidad=$request->cantidad[$i];
                $detallepedido->carrito=0;
                $id_obra=$detallepedido->id_obra;
                $subtotal+=$request->cantidad[$i]*$detallepedido->precio;
                $arraydetallepedido[]=$detallepedido;
            }
            
            
        }
       

        //No avanza si los registros ya no estan en el carrito
        if(count($arraydetallepedido)==0){
            return redirect('carrito')->with('error', 'Carrito vacio.');
        }
        $obra=Obra::find($id_obra);
        $configuraciones=Configuracion::where('id_municipio',$obra->id_municipio)->first();
        $total=$subtotal+($subtotal*($configuraciones->iva/100));
      
        if(!PuedeGastar($id_obra,$total)){
            return Redirect::back()->with('error', 'No puede generar pedido por falta de saldo.');
        }


        $pedido=new Pedido();
        $id_pedido=GetUuid();
        $pedido->id=$id_pedido; 
        $pedido->id_municipio=$obra->id_municipio;
        $pedido->id_obra=$id_obra;
        $pedido->id_usuario=$id_usuario;
        $pedido->obra=$obra->obra;
        $pedido->direccion=$obra->calle.' '.$obra->numeroext.' '.$obra->numeroint.','.$obra->colonia.','.$obra->municipo.','.$obra->entidad.','.$obra->cp;
        $pedido->latitud=$obra->latitud;
        $pedido->longitud=$obra->longitud;
        $pedido->telefono=$obra->telefono;
        $pedido->correo=$obra->correo;
        $pedido->fechaentrega=date('Y-m-d');
        $pedido->instrucciones=$request->instrucciones==null ? '' : $request->instrucciones;
        $pedido->subtotal= $subtotal;
        $pedido->iva = $obra->ivaobra;
        $pedido->total=$total;
       
        if($pedido->save()){
            foreach($arraydetallepedido as $detalle){                
                $detalle->id_pedido=$id_pedido;
                if(!$detalle->save()){
                    return redirect('carrito')->with('error', 'Error al guardar.');
                }
            }
            Notificar('Nuevo Pedido','Nuevo Pedido.','','Se ha generado un nuevo pedido de '.$obra->obra.' para la confirmación.',['emiliano@csmx.mx','ventas@csmx.mx','miriam@csmx.mx'],'<a href="https://reci-trash.mx" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return redirect('pedidos')->with('success', 'Registro guardado.');
        }else{
            return redirect('pedidos')->with('error', 'Error al guardar.');  
        }
    }

    public function show($id)
    {
        $productos = DB::table('productosobras')
        ->join('detallepedidos','detallepedidos.id_producto','=','productosobras.id')
        ->join('pedidos','pedidos.id','=','detallepedidos.id_pedido')
        ->select('detallepedidos.id','productosobras.categoria','productosobras.producto','productosobras.descripcion','detallepedidos.precio','productosobras.transporte','detallepedidos.cantidad',
        DB::raw('(select foto from productofotos where id_producto=productosobras.id_producto and orden=0) as portada'))
        ->where('pedidos.id',$id)
        ->get();
        
        $transportes = DB::table('transporteobras')
        ->join('detallepedidos','detallepedidos.id_transporte','=','transporteobras.id')
        ->join('pedidos','pedidos.id','=','detallepedidos.id_pedido')
        ->select('detallepedidos.id','transporteobras.transporte as producto','transporteobras.descripcion','detallepedidos.precio','transporteobras.transporte','detallepedidos.cantidad',
        DB::raw('(select foto from productofotos where id_producto=transporteobras.id_transporte and orden=0) as portada')
        ,DB::raw('\'Transporte\' as categoria'))
        ->where('pedidos.id',$id)
        ->get();

        $pedido = DB::table('pedidos')  
        ->where('pedidos.id',$id)
        ->first();


        return view('generales.pedidos.revisar',['pedido'=>$pedido,'productos'=>$productos,'transportes'=>$transportes]);
    }

    function Catalogo(){
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
        $cart = DetallePedido::where('id_usuario',$id_usuario)->get()->where('carrito',1)->count();
            
        if(Auth::guard('clientes')->check()){
            $obras = DB::table('clientes')            
            ->join('generadores', 'generadores.id_cliente', '=', 'clientes.id')
            ->join('obras', 'obras.id_generador', '=', 'generadores.id')
            ->select('obras.id','obras.obra')
            ->where('clientes.id',$id_usuario)            
            ->where('obras.verificado',1)     
            ->get();
        }  
        if(Auth::guard('residentes')->check()){
            $obras = DB::table('residentes')
            ->join('residentesobras','residentesobras.id_residente', '=', 'residentes.id')
            ->join('obras', 'obras.id', '=', 'residentesobras.id_obra')
            ->select('obras.id','obras.obra')
            ->where('residentes.id',$id_usuario)            
            ->where('obras.verificado',1)     
            ->get();
        }

        return view('generales.pedidos.catalogo',['obras'=>$obras,'cart'=>$cart]);
    }

    function Carrito(){
        
        $id_usuario = Auth::guard('clientes')->check()==false ? Auth::guard('residentes')->user()->id : Auth::guard('clientes')->user()->id;
        
        $productos = DB::table('productosobras')
        ->join('detallepedidos','detallepedidos.id_producto','=','productosobras.id')
        ->select('detallepedidos.id','productosobras.categoria','productosobras.producto','productosobras.descripcion','detallepedidos.precio','productosobras.transporte','detallepedidos.cantidad','detallepedidos.unidades',
        DB::raw('(select foto from productofotos where id_producto=productosobras.id_producto and orden=0) as portada'))
        ->where('carrito',1)
        ->where('id_usuario',$id_usuario)
        ->get();
        
        $transportes = DB::table('transporteobras')
        ->join('detallepedidos','detallepedidos.id_transporte','=','transporteobras.id')
        ->select('detallepedidos.id','transporteobras.transporte as producto','transporteobras.descripcion','detallepedidos.precio','transporteobras.transporte','detallepedidos.cantidad',
        DB::raw('(select foto from productofotos where id_producto=transporteobras.id_transporte and orden=0) as portada')
        ,DB::raw('\'Transporte\' as categoria'))
        ->where('carrito',1)
        ->where('id_usuario',$id_usuario)
        ->get();

        $pedido = DB::table('detallepedidos')
        ->join('obras','obras.id','=','detallepedidos.id_obra')
        ->select('obras.id_municipio')
        ->where('carrito',1)
        ->where('id_usuario',$id_usuario)
        ->first();

        /**
         * Pone un iva en 0 por si no hay nada en el carrito
         */
        $configuraciones=json_decode('{"iva":0}');
        if($pedido){
            $configuraciones=Configuracion::where('id_municipio',$pedido->id_municipio)->first();
        }
        
        

       
        return view('generales.pedidos.carrito',['productos'=>$productos,'transportes'=>$transportes,'iva'=>$configuraciones->iva]);
    }

    function QuitardelCarrito($id){
        $producto=DetallePedido::find($id);
        if(strlen($producto->id_pedido)==32){            
            return Redirect::back()->with('error', 'Error, No se pueden quitar productos de un pedido confirmado o rechazado.');
        }
        if($producto->delete()){
            return Redirect::back()->with('success', 'Se quitó del carrito.');
        }else{
            return Redirect::back()->with('error', 'Error. No puede quitar del carrito.');
        }
    }
}
