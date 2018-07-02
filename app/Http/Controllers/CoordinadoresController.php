<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Coordinador;
use App\Profesor;
use Illuminate\Http\Request;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;

class CoordinadoresController extends Controller
{
    public function index()
    {
        $coordinadores = Coordinador::all( )->where('activocoordinador','=','TRUE');
        return view('coordinadores.index', compact('coordinadores'));
    }

    public function create()
    {
        $carrerasutilizadas = Coordinador::pluck('idcarrera')->all();
        $carreras = Carrera::whereNotIn('idcarrera', $carrerasutilizadas)->select('idcarrera','nombrecarrera')->get();
        $profesores = Profesor::all();
        return view('coordinadores.create')->with(compact('carreras', 'profesores'));
    }
    public function change(Coordinador $coordinador)
    {
        $carreras =Carrera::all();
        $profesores = Profesor::all();
        return view('coordinadores.change')->with(compact('coordinador', 'carreras', 'profesores'));
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
            'fechafincoordinador'      => request('fin'),
            'activocoordinador'      => request('activo')
        ]);


        // redirect
        return redirect('coordinadores');

    }


    public function show(Coordinador $coordinador)
    {
        return view('coordinadores.show')->with('coordinador', $coordinador);

    }


    public function edit(Coordinador $coordinador)
    {
        $carreras =Carrera::all();
        $profesores = Profesor::all();
        return view('coordinadores.edit')->with(compact('coordinador', 'carreras', 'profesores'));
    }



    /*public function update(Request $request, $id)
    {
        $rules = array(
            'carrera'       => 'required',
            'profesor'       => 'required',
            'inicio'    => 'required',
            'fin'    => 'required',
            'activo'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Coordinador::updateOrCreate(['idcoordinador'  => $id], [
            'idcarrera'       => request('carrera'),
            'idprofesor'       => request('profesor'),
            'fechainiciocoordinador'      => request('inicio'),
            'fechafincoordinador'      => request('fin'),
            'activocoordinador'      => request('activo')
        ]);


        // redirect
        return redirect('coordinadores');
    }*/
    public function update(Request $request, $id)
    {
        $rules = array(
            'fin'    => 'required',
            'activo'    => 'required'

        );
        $this->validate(request(), $rules);


        // store
        Coordinador::updateOrCreate(['idcoordinador'  => $id], [
            'fechafincoordinador'      => request('fin'),
            'activocoordinador'      => request('activo')
        ]);
        return back();


    }


    public function destroy($coordinador)
    {
        Coordinador::find($coordinador)
            ->delete();

        return redirect('coordinadores');
    }
}
