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

Route::get('/carreras', 'CarrerasController@index');
Route::get('/carreras/create', 'CarrerasController@create');
Route::get('/carreras/{escuela}', 'CarrerasController@show');
Route::post('/carreras', 'CarrerasController@store');
Route::get('/carreras/{carrera}/edit', 'CarrerasController@edit');
Route::put('/carreras/{carrera}', 'CarrerasController@update');
Route::delete('/carreras/{carrera}', 'CarrerasController@destroy');
Route::get('/carreras/{escuela}/create', 'CarrerasController@createfrom');
Route::get('/carreras/{escuela}/list', 'CarrerasController@indexfrom');

Route::get('/escuelas', 'EscuelasController@index');
Route::get('/escuelas/create', 'EscuelasController@create');
Route::get('/escuelas/{escuela}', 'EscuelasController@show');
Route::post('/escuelas', 'EscuelasController@store');
Route::get('/escuelas/{escuela}/edit', 'EscuelasController@edit');
Route::put('/escuelas/{escuela}', 'EscuelasController@update');
Route::delete('/escuelas/{escuela}', 'EscuelasController@destroy');
Route::get('/escuelas/{facultad}/create', 'EscuelasController@createfrom');
Route::get('/escuelas/{facultad}/list', 'EscuelasController@indexfrom');

Route::get('/facultades', 'FacultadesController@index');
Route::get('/facultades/create', 'FacultadesController@create');
Route::get('/facultades/{sede}', 'FacultadesController@show');
Route::post('/facultades', 'FacultadesController@store');
Route::get('/facultades/{facultad}/edit', 'FacultadesController@edit');
Route::put('/facultades/{facultad}', 'FacultadesController@update');
Route::delete('/facultades/{facultad}', 'FacultadesController@destroy');
Route::get('/facultades/{sede}/create', 'FacultadesController@createfrom');
Route::get('/facultades/{sede}/list', 'FacultadesController@indexfrom');

Route::get('/sedes', 'SedesController@index');
Route::get('/sedes/create', 'SedesController@create');
Route::get('/sedes/{sede}', 'SedesController@show');
Route::post('/sedes', 'SedesController@store');
Route::get('/sedes/{sede}/edit', 'SedesController@edit');
Route::put('/sedes/{sede}', 'SedesController@update');
Route::delete('/sedes/{sede}', 'SedesController@destroy');
Route::get('/sedes/{universidad}/create', 'SedesController@createfrom');
Route::get('/sedes/{universidad}/list', 'SedesController@indexfrom');

Route::get('/tutores', 'TutorEsController@index');
Route::get('/tutores/create', 'TutorEsController@create');
Route::get('/tutores/{empresa}', 'TutorEsController@show');
Route::post('/tutores', 'TutorEsController@store');
Route::get('/tutores/{tutore}/edit', 'TutorEsController@edit');


Route::get('/estasignaturas/{carrera}/create/{estudiante}', 'EstudiantexAsignaturaController@create');

Route::get('/tutores/{empresa}/create', 'TutorEsController@createfrom');
Route::get('/tutores/{empresa}/list', 'TutorEsController@indexfrom');
Route::put('/tutores/{tutore}', 'TutorEsController@update');
Route::delete('/tutores/{empresa}', 'TutorEsController@destroy');

Route::get('/estudiantes', 'EstudiantesController@index');
Route::get('/estudiantes/create', 'EstudiantesController@create');
Route::get('/estudiantes/{estudiante}', 'EstudiantesController@show');
Route::post('/estudiantes', 'EstudiantesController@store');
Route::get('/estudiantes/{estudiante}/edit', 'EstudiantesController@edit');
Route::put('/estudiantes/{estudiante}', 'EstudiantesController@update');
Route::delete('/estudiantes/{estudiante}', 'EstudiantesController@destroy');

Route::get('/practicas', 'PracticasController@index');
Route::get('/practicas/create', 'PracticasController@create');
Route::get('/practicas/{practica}', 'PracticasController@show');
Route::post('/practicas', 'PracticasController@store');
Route::get('/practicas/{practica}/edit', 'PracticasController@edit');
Route::put('/practicas/{practica}', 'PracticasController@update');
Route::delete('/practicas/{practica}', 'PracticasController@destroy');