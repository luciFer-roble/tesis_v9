<?php

namespace App\Http\Controllers;

use App\Sede;
use App\Universidad;
use Illuminate\Http\Request;

class SedesController extends Controller
{
    public function index()
    {
        $sedes = Sede::all();
        return view('sedes.index', compact('sedes'));
    }

    public function create()
    {
        $universidades =Universidad::all();
        return view('sedes.create')->with(compact('universidades'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'universidad'       => 'required',
            'nombre'       => 'required',
            'descripcion'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Sede::create([
            'iduniversidad'       => request('universidad'),
            'nombresede'      => request('nombre'),
            'descripcionsede'      => request('descripcion')
        ]);


        // redirect
        return redirect('sedes');

    }


    public function show(Sede $sede)
    {
        return view('sedes.show')->with('sede', $sede);

    }


    public function edit(Sede $sede)
    {
        $universidades =Universidad::all();
        return view('sedes.edit')->with(compact('sede', 'universidades'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'universidad'       => 'required',
            'nombre'       => 'required',
            'descripcion'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Sede::updateOrCreate(['idsede'  => $id], [
            'iduniversidad'       => request('universidad'),
            'nombresede'      => request('nombre'),
            'descripcionsede'      => request('descripcion')
        ]);


        // redirect
        return redirect('sedes');
    }


    public function destroy($sede)
    {
        Sede::find($sede)
            ->delete();

        return redirect('sedes');
    }
}
