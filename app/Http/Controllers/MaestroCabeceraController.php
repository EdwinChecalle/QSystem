<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maestro_Cabeceras;

class MaestroCabeceraController extends Controller
{
    public function index(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $maestros = Maestro_Cabeceras::orderBy('n_id', 'desc')->paginate(5);
        }
        else{
            $maestros = Maestro_Cabeceras::where($criterio , 'like', '%'. $buscar .'%')->orderBy('n_id', 'desc')->paginate(5);
        }

        return [
            'pagination' => [
                'total'=> $maestros->total(),
                'current_page'=> $maestros->currentPage(),
                'per_page' => $maestros->perPage(),
                'last_page' => $maestros->lastPage(),
                'from' => $maestros->firstItem(),
                'to' => $maestros->lastItem(),
            ],
            'maestrocabecera' => $maestros
        ];
    }

    public function listarMaestrocabecera(Request $request){
        if(!$request-> ajax()) return redirect('/');
        $maestros = Maestro_Cabeceras::where('l_estado', '=', '1')
        ->select('n_id','t_nombre')->orderBy('t_nombre', 'asc')->get();
        return ['maestrocabecera' => $maestros];
    }

    public function store(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestros = new  Maestro_Cabeceras();
        $maestros->t_nombre = $request->t_nombre;
        $maestros->t_descripcion = $request->t_descripcion;
        $maestros->l_estado = '1';
        $maestros->save();
    }
    
    public function update(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestros = Maestro_Cabeceras::findOrFail($request->n_id);
        $maestros->t_nombre = $request->t_nombre;
        $maestros->t_descripcion = $request->t_descripcion;
        $maestros->l_estado = '1';
        $maestros->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestros = Maestro_Cabeceras::findOrFail($request->n_id);
        $maestros->l_estado = '0';
        $maestros->save();
    }

    public function activar(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestros = Maestro_Cabeceras::findOrFail($request->n_id);
        $maestros->l_estado = '1';
        $maestros->save();
    }

}
