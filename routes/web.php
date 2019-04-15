<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('/maestrocabecera', 'MaestroCabeceraController@index');
Route::post('/maestrocabecera/registrar', 'MaestroCabeceraController@store');
Route::put('/maestrocabecera/actualizar', 'MaestroCabeceraController@update');
Route::put('/maestrocabecera/desactivar', 'MaestroCabeceraController@desactivar');
Route::put('/maestrocabecera/activar', 'MaestroCabeceraController@activar');
Route::get('/maestrocabecera/listarMaestrocabecera', 'MaestroCabeceraController@listarMaestrocabecera');

Route::get('/maestrodetalle', 'MaestroDetalleController@index');
Route::post('/maestrodetalle/registrar', 'MaestroDetalleController@store');
Route::put('/maestrodetalle/actualizar', 'MaestroDetalleController@update');
Route::put('/maestrodetalle/desactivar', 'MaestroDetalleController@desactivar');
Route::put('/maestrodetalle/activar', 'MaestroDetalleController@activar');
Route::get('/maestrodetalle/listarMaestroDetalle', 'MaestroDetalleController@listarMaestroDetalle');

Route::get('/cotizacion', 'CotizacionController@index');
Route::post('/cotizacion/registrar', 'CotizacionController@store');
Route::put('/cotizacion/actualizar', 'CotizacionController@update');
Route::put('/cotizacion/desactivar', 'CotizacionController@desactivar');
Route::put('/cotizacion/activar', 'CotizacionController@activar');