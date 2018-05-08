<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\Empresa;
use App\Sede;
use Illuminate\Http\Request;

class ConveniosController extends Controller
{
    public function index()
    {
        $convenios = Convenio::all();
        return view('convenios.index', compact('convenios'));
    }

    public function create()
    {
        $sedes = Sede::all();
        $empresas =Empresa::all();
        return view('convenios.create')->with(compact('sedes', 'empresas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'sede'       => 'required',
            'empresa'       => 'required',
            'direccion'    => 'required',
            'inicio'       => 'required',
            'fin'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Convenio::create([
            'idsede'       => request('sede'),
            'idempresa'       => request('empresa'),
            'descripcionconvenio'      => request('descripcion'),
            'fechainicioconvenio'      => request('inicio'),
            'fechafinconvenio' => request('fin'),
            'archivoconvenio' => request('archivo')
        ]);


        // redirect
        return redirect('convenios');

    }


    public function show(Convenio $convenio)
    {
        return view('convenios.show')->with('convenio', $convenio);

    }


    public function edit(Convenio $convenio)
    {
        $sedes = Sede::all();
        $empresas =Empresa::all();
        return view('convenios.edit')->with(compact('convenio', 'sedes', 'empresas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'sede'       => 'required',
            'empresa'       => 'required',
            'direccion'    => 'required',
            'inicio'       => 'required',
            'fin'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Convenio::updateOrCreate(['idconvenio'  => $id], [
            'idsede'       => request('sede'),
            'idempresa'       => request('empresa'),
            'descripcionconvenio'      => request('descripcion'),
            'fechainicioconvenio'      => request('inicio'),
            'fechafinconvenio' => request('fin'),
            'archivoconvenio' => request('archivo')
        ]);


        // redirect
        return redirect('convenios');
    }


    public function destroy($convenio)
    {
        Convenio::find($convenio)
            ->delete();

        return redirect('convenios');
    }
}
