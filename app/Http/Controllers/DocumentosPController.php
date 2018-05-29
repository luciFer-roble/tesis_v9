<?php

namespace App\Http\Controllers;

use App\DocumentoP;
use App\Practica;
use App\TipoDocumento;
use Illuminate\Http\Request;

class DocumentosPController extends Controller
{
    public function index()
    {
        $documentosp = DocumentoP::all();
        return view('documentosp.index', compact('documentosp'));
    }

    public function create()
    {
        $tiposdocumento =TipoDocumento::all();
        $practicas = Practica::all();
        return view('documentosp.create')->with(compact('tiposdocumento', 'practicas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'tipo'       => 'required',
            'practica'       => 'required',
            'archivo'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        DocumentoP::create([
            'idtipodocumento'       => request('tipo'),
            'idpractica'       => request('practica'),
            'archivodocumentop'      => request('archivo')
        ]);


        // redirect
        return redirect('documentosp');

    }


    public function show(DocumentoP $documentop)
    {
        return view('documentosp.show')->with('documentop', $documentop);

    }


    public function edit(DocumentoP $documentop)
    {
        $tiposdocumento =TipoDocumento::all();
        $practicas = Practica::all();
        return view('documentosp.edit')->with(compact('documentop', 'tiposdocumento', 'practicas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'tipo'       => 'required',
            'practica'       => 'required',
            'archivo'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        DocumentoP::updateOrCreate(['iddocumentop'  => $id], [
            'idtipodocumento'       => request('tipo'),
            'idpractica'       => request('practica'),
            'archivodocumentop'      => request('archivo')
        ]);


        // redirect
        return redirect('documentosp');
    }


    public function destroy($documentop)
    {
        DocumentoP::find($documentop)
            ->delete();

        return redirect('documentosp');
    }
}
