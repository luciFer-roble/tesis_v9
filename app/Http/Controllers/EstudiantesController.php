<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Escuela;
use App\Estudiante;
use App\Facultad;
use App\Sede;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
        return view('estudiantes.create')->with(compact('carreras', 'escuelas', 'facultades', 'sedes'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'carrera'       => 'required',
            'cedula'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'tipo'    => 'required',
            'celular'    => 'required',
            'correo'    => 'required',
            'fechanacimiento'    => 'required',
            'genero'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Estudiante::create([
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombre1estudiante'      => request('nombre1'),
            'nombre2estudiante'      => request('nombre2'),
            'apellido1estudiante'      => request('apellido1'),
            'apellido2estudiante'      => request('apellido2'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero')
        ]);


        // redirect
        return redirect('estudiantes');

    }


    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show')->with('estudiante', $estudiante);

    }


    public function edit(Estudiante $estudiante)
    {
        $carreras =Carrera::all();
        return view('estudiantes.edit')->with(compact('estudiante', 'carreras'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'carrera'       => 'required',
            'cedula'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'tipo'    => 'required',
            'celular'    => 'required',
            'correo'    => 'required',
            'fechanacimiento'    => 'required',
            'genero'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Escuela::updateOrCreate(['idestudiante'  => $id], [
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombre1estudiante'      => request('nombre1'),
            'nombre2estudiante'      => request('nombre2'),
            'apellido1estudiante'      => request('apellido1'),
            'apellido2estudiante'      => request('apellido2'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero')
        ]);


        // redirect
        return redirect('estudiantes');
    }


    public function destroy($estudiante)
    {
        Estudiante::find($estudiante)
            ->delete();

        return redirect('estudiantes');
    }
}
