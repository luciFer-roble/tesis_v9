<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('lista_asignaturas','ConsultasController@listarasignaturas');
Route::get('consultar-practicas','ConsultasController@consultarpracticas');
Route::get('listar-select1','ConsultasController@listarselect1');
Route::get('consultar2-practicas','ConsultasController@consultarpracticas2');
Route::get('todo-practicas','ConsultasController@todaslaspracticas');
Route::get('totaldocs','ConsultasController@totaldocs');