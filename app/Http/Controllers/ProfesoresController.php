<?php

namespace App\Http\Controllers;

use App\Escuela;
use App\Profesor;
use Illuminate\Http\Request;

class ProfesoresController extends Controller
{
    public function index()
    {
        $profesores = Profesor::all();
        $escuelas = Escuela::all();
        return view('profesores.index', compact('profesores','escuelas'));
    }

    public function create()
    {
        $escuelas =Escuela::all();
        return view('profesores.create')->with(compact('escuelas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'escuela'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'correo'    => 'required',
            'oficina'    => 'required',
            'celular'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Profesor::create([
            'idprofesor'       => request('id'),
            'idescuela'       => request('escuela'),
            'nombre1profesor'      => request('nombre1'),
            'nombre2profesor'      => request('nombre2'),
            'apellido1profesor'      => request('apellido1'),
            'apellido2profesor'      => request('apellido2'),
            'correoprofesor'      => request('correo'),
            'oficinaprofesor'      => request('oficina'),
            'celularprofesor'      => request('celular')
        ]);


        // redirect
        return redirect('profesores');

    }


    public function show(Profesor $profesor)
    {
        return view('profesores.show')->with('profesor', $profesor);

    }


    public function edit(Profesor $profesor)
    {
        $escuelas =Escuela::all();
        return view('profesores.edit')->with(compact('profesor', 'escuelas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'escuela'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'correo'    => 'required',
            'oficina'    => 'required',
            'celular'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Profesor::updateOrCreate(['idprofesor'  => $id], [
            'idescuela'       => request('escuela'),
            'nombre1profesor'      => request('nombre1'),
            'nombre2profesor'      => request('nombre2'),
            'apellido1profesor'      => request('apellido1'),
            'apellido2profesor'      => request('apellido2'),
            'correoprofesor'      => request('correo'),
            'oficinaprofesor'      => request('oficina'),
            'celularprofesor'      => request('celular')
        ]);


        // redirect
        return redirect('profesores');
    }


    public function destroy($profesor)
    {
        Profesor::find($profesor)
            ->delete();

        return redirect('profesores');
    }
}
