<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maestro_Detalles;

class MaestroDetalleController extends Controller
{
    public function index(Request $request)
    {
        //if(!$request-> ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $maestrodetalle = Maestro_Detalles::join('maestro_cabeceras','maestro_detalles.n_id_maestrocabecera', '=', 'maestro_cabeceras.n_id')
            ->select('maestro_detalles.n_id','maestro_detalles.n_id_maestrocabecera','maestro_detalles.c_codigodetalle','maestro_detalles.t_nombre','maestro_detalles.t_nombrecorto','maestro_detalles.l_estado','maestro_cabeceras.t_nombre as t_nombremacabecera','t_referencia')
            ->orderBy('maestro_detalles.n_id', 'desc')->paginate(5);
        }
        else{
            $maestrodetalle = Maestro_Detalles::join('maestro_cabeceras','maestro_detalles.n_id_maestrocabecera', '=', 'maestro_cabeceras.n_id')
            ->select('maestro_detalles.n_id','maestro_detalles.n_id_maestrocabecera','maestro_detalles.c_codigodetalle','maestro_detalles.t_nombre','maestro_detalles.t_nombrecorto','maestro_detalles.l_estado','maestro_cabeceras.t_nombre as t_nombrecabecera','t_referencia')
            ->where('maestro_detalles.' .$criterio , 'like', '%'. $buscar .'%')
            ->orderBy('maestro_detalles.n_id', 'desc')->paginate(5);
        }

        return [
            'pagination' => [
                'total'=> $maestrodetalle->total(),
                'current_page'=> $maestrodetalle->currentPage(),
                'per_page' => $maestrodetalle->perPage(),
                'last_page' => $maestrodetalle->lastPage(),
                'from' => $maestrodetalle->firstItem(),
                'to' => $maestrodetalle->lastItem(),
            ],
            'maestrodetalle' => $maestrodetalle
        ];
    }

    public function store(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestrodetalle = new  Maestro_Detalles();
        $maestrodetalle->n_id_maestrocabecera = $request->n_id_maestrocabecera;
        $maestrodetalle->c_codigodetalle = $request->c_codigodetalle;
        $maestrodetalle->t_nombre = $request->t_nombre;
        $maestrodetalle->t_nombrecorto = $request->t_nombrecorto;
        $maestrodetalle->t_referencia = $request->t_referencia;
        $maestrodetalle->l_estado = '1';
        $maestrodetalle->save();
    }

    public function update(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestrodetalle = Maestro_Detalles::findOrFail($request->n_id);
        $maestrodetalle->n_id_maestrocabecera = $request->n_id_maestrocabecera;
        $maestrodetalle->c_codigodetalle = $request->c_codigodetalle;
        $maestrodetalle->t_nombre = $request->t_nombre;
        $maestrodetalle->t_nombrecorto = $request->t_nombrecorto;
        $maestrodetalle->t_referencia = $request->t_referencia;
        $maestrodetalle->l_estado = '1';
        $maestrodetalle->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestrodetalle = Maestro_Detalles::findOrFail($request->n_id);
        $maestrodetalle->l_estado = '0';
        $maestrodetalle->save();
    }

    public function activar(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $maestrodetalle = Maestro_Detalles::findOrFail($request->n_id);
        $maestrodetalle->l_estado = '1';
        $maestrodetalle->save();
    }
}
