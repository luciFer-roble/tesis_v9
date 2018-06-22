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
    return view('layouts.master');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/master',function (){
    return view ('layouts.master');
});

Route::get('/empresas', 'EmpresasController@index');
Route::get('/empresas/create', 'EmpresasController@create');
Route::get('/empresas/{empresa}', 'EmpresasController@show');
Route::post('/empresas', 'EmpresasController@store');
Route::get('/empresas/{empresa}/edit', 'EmpresasController@edit');
Route::put('/empresas/{empresa}', 'EmpresasController@update');
Route::delete('/empresas/{empresa}', 'EmpresasController@destroy');

Route::get('/tutores', 'TutorEsController@index');
Route::get('/tutores/create', 'TutorEsController@create');
Route::get('/tutores/{empresa}', 'TutorEsController@show');
Route::post('/tutores', 'TutorEsController@store');
Route::get('/tutores/{tutore}/edit', 'TutorEsController@edit');

Route::get('/tutores/{empresa}/create', 'TutorEsController@createfrom');
Route::get('/tutores/{empresa}/list', 'TutorEsController@indexfrom');
Route::put('/tutores/{tutore}', 'TutorEsController@update');
Route::delete('/tutores/{empresa}', 'TutorEsController@destroy');