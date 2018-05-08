<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TutorE;
use App\Empresa;

class TutorEsController extends Controller
{
    public function index()
    {
        $tutores = TutorE::all();
        return view('tutores.index', compact('tutores'));
    }

    public function create()
    {
        $empresas =Empresa::all();
        return view('tutores.create')->with(compact('empresas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'empresa'       => 'required',
            'nombre'       => 'required',
            'apellido'    => 'required',
            'celular'       => 'required',
            'correo'     => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TutorE::create([
            'idempresa'       => request('empresa'),
            'nombretutore'       => request('nombre'),
            'apellidotutore'      => request('apellido'),
            'celulartutore'      => request('celular'),
            'correotutore' => request('correo')
        ]);


        // redirect
        return redirect('tutores');

    }


    public function show(TutorE $tutore)
    {
        return view('tutores.show')->with('tutore', $tutore);

    }


    public function edit(TutorE $tutore)
    {
        $empresas =Empresa::all();
        return view('tutores.edit')->with(compact('tutore', 'empresas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'empresa'       => 'required',
            'nombre'       => 'required',
            'apellido'    => 'required',
            'celular'       => 'required',
            'correo'     => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TutorE::updateOrCreate(['idtutore'  => $id], [
            'idempresa'       => request('empresa'),
            'nombretutore'       => request('nombre'),
            'apellidotutore'      => request('apellido'),
            'celulartutore'      => request('celular'),
            'correotutore' => request('correo')
        ]);


        // redirect
        return redirect('tutores');
    }


    public function destroy($tutore)
    {
        TutorE::find($tutore)
            ->delete();

        return redirect('tutores');
    }
}
