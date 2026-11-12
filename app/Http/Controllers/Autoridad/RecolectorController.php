<?php

namespace App\Http\Controllers\Autoridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recolector;
use Redirect;

class RecolectorController extends Controller
{
    public function index(Request $filtros)
    {
        $recolectores = DB::table('recolectores')
        ->orderby('apellidos','asc')
        ->whereraw(" nombres like '%$filtros->recolector%' or apellidos like '%$filtros->recolector%' ")
        ->paginate(36);

        return view('autoridad.recolectores.index',['recolectores'=>$recolectores,'filtros'=>$filtros]);
    }

    public function store(Request $request)
    {
        $correo = BuscarCorreo($request->mail);
        if($correo != ''){
            return Redirect::back()->with('error','El correo ya fue registrado anteriormente en '.$correo);
        }

        $recolector = new Recolector();
        $recolector->id         = GetUuid();
        $recolector->nombres    = $request->nombres;
        $recolector->apellidos  = $request->apellidos;
        $recolector->mail       = $request->mail;
        $recolector->telefono   = $request->telefono;
        $recolector->pass       = '';
        $recolector->temp       = \Illuminate\Support\Str::random(6);

        if($recolector->save()){
            return redirect('autoridad/recolectores')->with('success','Registro guardado.');
        }else{
            return Redirect::back()->with('error','Error al guardar el registro.');
        }
    }

    public function show($id)
    {
        $recolector = Recolector::find($id);
        return view('autoridad.recolectores.show',['recolector'=>$recolector]);
    }

    public function update(Request $request, $id)
    {
        $correo = BuscarCorreo($request->mail);
        if($correo != ''){
            return Redirect::back()->with('error','El correo ya fue registrado anteriormente en '.$correo);
        }

        $recolector = Recolector::find($id);

        $recolector->nombres   = $request->nombres;
        $recolector->apellidos = $request->apellidos;
        $recolector->mail      = isset($request->mail) ? $request->mail : $recolector->mail;
        $recolector->telefono  = $request->telefono;

        if($recolector->save()){
            return redirect('autoridad/recolectores/'.$id)->with('success','Registro actualizado.');
        }else{
            return Redirect::back()->with('error','Error al guardar el registro.');
        }
    }

    public function destroy($id)
    {
        $recolector = Recolector::find($id);

        if (!$recolector) {
            return response()->json([
                'success' => false,
                'message' => 'El recolector no existe.'
            ], 404);
        }

        try {
            $recolector->delete();
            return response()->json([
                'success' => true,
                'message' => 'Recolector eliminado correctamente.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el recolector: ' . $e->getMessage()
            ], 500);
        }
    }
}