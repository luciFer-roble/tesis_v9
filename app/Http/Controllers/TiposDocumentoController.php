<?php

namespace App\Http\Controllers;

use App\TipoDocumento;
use Illuminate\Http\Request;

class TiposDocumentoController extends Controller
{
    public function index()
    {
        $tiposdocumento = TipoDocumento::all();
        return view('tiposdocumento.index', compact('tiposdocumento'));
    }

    public function create()
    {
        return view('tiposdocumento.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'id'       => 'required',
            'descripcion'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TipoDocumento::create([
            'idtipodocumento'       => request('id'),
            'descripciontipodocumento'      => request('descripcion')
        ]);


        // redirect
        return redirect('tiposdocumento');

    }


    public function show(TipoDocumento $tipodocumento)
    {
        return view('tiposdocumento.show')->with('tipodocumento', $tipodocumento);

    }


    public function edit(TipoDocumento $tipodocumento)
    {
        return view('tiposdocumento.edit')->with(compact('tipodocumento'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'descripcion'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Profesor::updateOrCreate(['idtipodocumento'  => $id], [
            'descripciontipodocumento'      => request('descripcion')
        ]);


        // redirect
        return redirect('tiposdocumento');
    }


    public function destroy($tipodocumento)
    {
        TipoDocumento::find($tipodocumento)
            ->delete();

        return redirect('tiposdocumento');
    }
}
