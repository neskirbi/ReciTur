<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Campamento;



class CampamentoController extends Controller
{
    function index(){
        $campamentos = Campamento::get(); 
        
        

        return view(' cliente.campamentos.campamentos',['campamentos'=> $campamentos]);
    }


    function create(){
        return view(' cliente.campamentos.create');
    }
   
    function store(Request $request)
    {
        //return $request;
        $campamentos =new Campamento();
        $id = $campamentos->id = GetUuid();
        $campamentos->arearesponsable=$request->arearesponsable;
        $campamentos->calle=$request->calle;
        $campamentos->colonia=$request->colonia;
        $campamentos->alcaldia=$request->alcaldia;
        $campamentos->codigopostal=$request->codigopostal;
        $campamentos->telefono=$request->telefono;
        
        $campamentos->nombreresponsablecamp=$request->nombreresponsablecamp;
        

        if($campamentos->save()){
            return redirect(url('campamentos'))->with('success', 'Registro de campamento exitoso');
        }else{
            return Redirect::back();
        }
    }

    function show($id){
        $campamentos=Campamento::find($id);
        return view('cliente.campamentos.editarcampamento',['campamentos'=> $campamentos]);
        

    }

    function update(Request $request,$id){
        
        $campamentos=Campamento::find($id);

        $campamentos->arearesponsable=$request->arearesponsable;
        $campamentos->calle=$request->calle;
        $campamentos->colonia=$request->colonia;
        $campamentos->alcaldia=$request->alcaldia;
        $campamentos->codigopostal=$request->codigopostal;
        $campamentos->telefono=$request->telefono;
        
        $campamentos->nombreresponsablecamp=$request->nombreresponsablecamp;
        
        if($empresa->save()){
            return redirect('campamentos/'.$id)->with('success','Registro de campamento exitoso');
        }else{
            return redirect('campamentos/'.$id)->with('error','Error al guardar el campamento');
        }
    }
}
