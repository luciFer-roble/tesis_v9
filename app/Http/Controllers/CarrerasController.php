<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Escuela;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all();
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        $escuelas =Escuela::all();
        return view('carreras.create')->with(compact('escuelas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'escuela'       => 'required',
            'nombre'       => 'required',
            'descripcion'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Carrera::create([
            'idescuela'       => request('escuela'),
            'nombrecarrera'       => request('nombre'),
            'descripcioncarrera'      => request('descripcion')
        ]);


        // redirect
        return redirect('carreras');

    }


    public function show(Carrera $carrera)
    {
        return view('carreras.show')->with('carrera', $carrera);

    }


    public function edit(Carrera $carrera)
    {
        $escuelas =Escuela::all();
        return view('carreras.edit')->with(compact('carrera', 'escuelas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'escuela'       => 'required',
            'nombre'       => 'required',
            'descripcion'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Carrera::updateOrCreate(['idcarrera'  => $id], [
            'idescuela'       => request('escuela'),
            'nombrecarrera'       => request('nombre'),
            'descripcioncarrera'      => request('descripcion')
        ]);


        // redirect
        return redirect('carreras');
    }


    public function destroy($carrera)
    {
        Carrera::find($carrera)
            ->delete();

        return redirect('carreras');
    }
}