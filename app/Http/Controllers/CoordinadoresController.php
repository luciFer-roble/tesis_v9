<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Coordinador;
use App\Profesor;
use Illuminate\Http\Request;

class CoordinadoresController extends Controller
{
    public function index()
    {
        $coordinadores = Coordinador::all();
        return view('coordinadores.index', compact('coordinadores'));
    }

    public function create()
    {
        $carreras =Carrera::all();
        $profesores = Profesor::all();
        return view('coordinadores.create')->with(compact('carreras', 'profesores'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'carrera'       => 'required',
            'profesor'       => 'required',
            'inicio'    => 'required',
            'fin'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Coordinador::create([
            'idcarrera'       => request('carrera'),
            'idprofesor'       => request('profesor'),
            'fechainiciocoordinador'      => request('inicio'),
            'fechafincoordinador'      => request('fin')
        ]);


        // redirect
        return redirect('coordinadores');

    }


    public function show(Coordinador $coordinador)
    {
        return view('coordinador.show')->with('coordinador', $coordinador);

    }


    public function edit(Coordinador $coordinador)
    {
        $carreras =Carrera::all();
        $profesores = Profesor::all();
        return view('coordinador.edit')->with(compact('coordinador', 'carreras', 'profesores'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'carrera'       => 'required',
            'profesor'       => 'required',
            'inicio'    => 'required',
            'fin'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Coordinador::updateOrCreate(['idcoordinador'  => $id], [
            'idcarrera'       => request('carrera'),
            'idprofesor'       => request('profesor'),
            'fechainiciocoordinador'      => request('inicio'),
            'fechafincoordinador'      => request('fin')
        ]);


        // redirect
        return redirect('coordinadores');
    }


    public function destroy($coordinador)
    {
        Coordinador::find($coordinador)
            ->delete();

        return redirect('coordinadores');
    }
}
