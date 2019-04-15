<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cotizacion;


class CotizacionController extends Controller
{
    public function index(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $cotizacion = Cotizacion::join('maestro_detalles as dt',function($join){
                $join->on("dt.n_id_maestrocabecera","=","cotizacion.n_tabla_tipoprenda")
                    ->on("dt.c_codigodetalle","=","cotizacion.c_tipoprenda");
                })
            ->join('maestro_detalles as dm',function($join){
                $join->on("dm.n_id_maestrocabecera","=","cotizacion.n_tabla_modeloprenda")
                    ->on("dm.c_codigodetalle","=","cotizacion.c_modeloprenda");
                })
            ->join('maestro_detalles as tt',function($join){
                    $join->on("tt.n_id_maestrocabecera","=","cotizacion.n_tabla_tipotela")
                        ->on("tt.c_codigodetalle","=","cotizacion.c_tipotela");
                })
            ->join('maestro_detalles as tnt',function($join){
                        $join->on("tnt.n_id_maestrocabecera","=","cotizacion.n_tabla_tonotela")
                            ->on("tnt.c_codigodetalle","=","cotizacion.c_tonotela");
                })         
            ->join('maestro_detalles as tnta',function($join){
                            $join->on("tnta.n_id_maestrocabecera","=","cotizacion.n_tabla_tenidotela")
                                ->on("tnta.c_codigodetalle","=","cotizacion.c_tenidotela");
                })
            ->join('maestro_detalles as gt',function($join){
                    $join->on("gt.n_id_maestrocabecera","=","cotizacion.n_tabla_grosortela")
                        ->on("gt.c_codigodetalle","=","cotizacion.c_grosortela");
                })                       
            ->select('cotizacion.n_id','cotizacion.n_precio','cotizacion.l_estado', 
                     'dt.t_nombre as t_tipoprenda','dm.t_nombre as t_modeloprenda',
                     'tt.t_nombre as t_tipotela','tnt.t_nombre as t_tonotela',
                     'tnta.t_nombre as t_tenidotela','gt.t_nombre as t_grosortela',
                     'c_tipoprenda','c_modeloprenda','c_tipotela','c_tonotela',
                     'c_tenidotela','c_grosortela','t_descripcion')
            ->orderBy('cotizacion.n_id', 'desc')->paginate(5);
        }
        else{
            $cotizacion = Cotizacion::join('maestro_detalles as dt')
            ->whereColumn([
                ['dt.n_id', '=', 'cotizacion.n_tabla_tipoprenda'],
                ['dt.c_codigodetalle', '=', 'cotizacion.c_tipoprenda']])
            ->select('cotizacion.n_id','cotizacion.n_precio','cotizacion.l_estado', 'dt.t_nombre as t_tipoprenda')
            ->orderBy('cotizacion.n_id', 'desc')->paginate(5);
        }

        return [
            'pagination' => [
                'total'=> $cotizacion->total(),
                'current_page'=> $cotizacion->currentPage(),
                'per_page' => $cotizacion->perPage(),
                'last_page' => $cotizacion->lastPage(),
                'from' => $cotizacion->firstItem(),
                'to' => $cotizacion->lastItem(),
            ],
            'cotizacion' => $cotizacion
        ];
    }

    public function store(Request $request){
        if(!$request-> ajax()) return redirect('/');
        $cotizacion = new Cotizacion();
        $cotizacion->n_tabla_tipoprenda = 1;
        $cotizacion->c_tipoprenda =  $request->c_tipoprenda;
        $cotizacion->n_tabla_modeloprenda = 2;
        $cotizacion->c_modeloprenda =  $request->c_modeloprenda;
        $cotizacion->n_tabla_tipotela = 3;
        $cotizacion->c_tipotela =  $request->c_tipotela;
        $cotizacion->n_tabla_tonotela = 4;
        $cotizacion->c_tonotela =  $request->c_tonotela;
        $cotizacion->n_tabla_tenidotela = 5;
        $cotizacion->c_tenidotela =  $request->c_tenidotela;
        $cotizacion->n_tabla_grosortela = 6;
        $cotizacion->c_grosortela =  $request->c_grosortela;
        $cotizacion->n_precio = $request->n_precio;
        $cotizacion->t_descripcion = $request->t_descripcion;
        $cotizacion->l_estado = '1';
        $cotizacion->save();

    }

    public function update(Request $request){
        if(!$request-> ajax()) return redirect('/');
        $cotizacion = Cotizacion::findOrFail($request->n_id);
        $cotizacion->n_tabla_tipoprenda = 1;
        $cotizacion->c_tipoprenda =  $request->c_tipoprenda;
        $cotizacion->n_tabla_modeloprenda = 2;
        $cotizacion->c_modeloprenda =  $request->c_modeloprenda;
        $cotizacion->n_tabla_tipotela = 3;
        $cotizacion->c_tipotela =  $request->c_tipotela;
        $cotizacion->n_tabla_tenidotela = 4;
        $cotizacion->c_tenidotela =  $request->c_tenidotela;
        $cotizacion->n_tabla_grosortela = 5;
        $cotizacion->c_grosortela =  $request->c_grosortela;
        $cotizacion->n_precio = $request->n_precio;
        $cotizacion->t_descripcion = $request->t_descripcion;
        $cotizacion->l_estado = '1';
        $cotizacion->save();

    }

    public function desactivar(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $cotizacion = Cotizacion::findOrFail($request->n_id);
        $cotizacion->l_estado = '0';
        $cotizacion->save();
    }

    public function activar(Request $request)
    {
        if(!$request-> ajax()) return redirect('/');
        $cotizacion = Cotizacion::findOrFail($request->n_id);
        $cotizacion->l_estado = '1';
        $cotizacion->save();
    }

}
