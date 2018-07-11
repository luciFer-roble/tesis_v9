<?php

namespace App\Http\Controllers;

use App\Formato;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormatosController extends Controller
{
    public function index()
    {
        $tiposdocumento = TipoDocumento::orderby('idtipodocumento')->get();
        $formatos = Formato::orderby('idformato')->get();
        return view('formatos.index', compact('tiposdocumento','formatos'));
    }

    public function create()
    {
        return view('formatos.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'id'       => 'required',
            'descripcion'       => 'required',
            'archivo'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TipoDocumento::create([
            'idtipodocumento'       => request('id'),
            'descripciontipodocumento'      => request('descripcion')
        ]);
        Formato::create([
            'idtipodocumento'       => request('id'),
            'archivoformato'      => $request->text('archivo')
        ]);

        $path   =   "app/formatos/";
        $file  =   $request->file('archivo');
        $name = request('id');

        $file->storeAs($path, $name);


        // redirect
        return redirect('formatos');

    }


    public function show(Formatos $formato)
    {
        return view('formatos.show')->with('formato', $formato);

    }


    public function edit(Formato $formato)
    {
        return view('formatos.edit')->with(compact('formato','tipodocumento'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'descripcion'       => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TipoDocumento::updateOrCreate(['idtipodocumento'  => $id], [
            'descripciontipodocumento'      => request('descripcion')
        ]);/*
        Formato::updateOrCreate(['idtipodocumento'  => $id], [
            'archivoformato'      => request('archivo')
        ]);*/
        DB::table('formato')
            ->where('idtipodocumento', $id)
            ->update(['archivoformato' => request('archivo')]);


        // redirect
        return redirect('formatos');
    }


    public function destroy($formato)
    {
        Formato::find($formato)
            ->delete();

        return redirect('formatos');
    }
}
