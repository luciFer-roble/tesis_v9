<?php

namespace App\Http\Controllers;

use App\Facultad;
use App\Sede;
use Illuminate\Http\Request;

class FacultadesController extends Controller
{
    public function index()
    {
        $facultades = Facultad::all();
        return view('facultades.index', compact('facultades'));
    }

    public function create()
    {
        $sedes =Sede::all();
        return view('facultades.create')->with(compact('sedes'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'sede'       => 'required',
            'nombre'       => 'required',
            'mision'       => 'required',
            'vision'    => 'required',
            'descripcion'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Facultad::create([
            'idsede'       => request('sede'),
            'nombrefacultad'      => request('nombre'),
            'misionfacultad'       => request('mision'),
            'visionfacultad'      => request('vision'),
            'descripcionfacultad'      => request('descripcion')
        ]);


        // redirect
        return redirect('facultades');

    }


    public function show(Facultad $facultad)
    {
        return view('facultades.show')->with('facultad', $facultad);

    }


    public function edit(Facultad $facultad)
    {
        $sedes =Sede::all();
        return view('facultades.edit')->with(compact('facultad', 'sedes'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'sede'       => 'required',
            'nombre'       => 'required',
            'mision'       => 'required',
            'vision'    => 'required',
            'descripcion'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Facultad::updateOrCreate(['idfacultad'  => $id], [
            'idsede'       => request('sede'),
            'nombrefacultad'      => request('nombre'),
            'misionfacultad'       => request('mision'),
            'visionfacultad'      => request('vision'),
            'descripcionfacultad'      => request('descripcion')
        ]);


        // redirect
        return redirect('facultades');
    }


    public function destroy($facultad)
    {
        Facultad::find($facultad)
            ->delete();

        return redirect('facultades');
    }
}
