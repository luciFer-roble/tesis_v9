<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\Empresa;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConveniosController extends Controller
{
    public function index()
    {
        $sedes = Sede::all();
        $empresas =Empresa::all();
        $convenios = Convenio::all();
        return view('convenios.index', compact('convenios','sedes', 'empresas'));
    }

    public function create()
    {
        $sedes = Sede::all();
        $empresas =Empresa::all();
        return view('convenios.create')->with(compact('sedes', 'empresas'));
    }

    public function indexfrom(Sede $sede)
    {
        $convenios = Convenio::all()->where('idsede', '=' , $sede->idsede );
        return view('convenios.index', compact('convenios'));
    }
    public function createfrom(Sede $sede)
    {
        $sedes =Sede::all();
        $empresas =Empresa::all();
        return view('convenios.create')->with(compact('sede', 'sedes','empresas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'id'       => 'required',
            'sede'       => 'required',
            'empresa'       => 'required',
            'descripcion'    => 'required',
            'inicio'       => 'required',
            'fin'       => 'required',
            'archivo'       => 'required'
        );
        $this->validate(request(), $rules);

        $file  =   $request->file('archivo');

        $name = request('id').'.'.$file->getClientOriginalExtension();

        // store
        Convenio::create([
            'idconvenio'       => request('id'),
            'idsede'       => request('sede'),
            'idempresa'       => request('empresa'),
            'descripcionconvenio'      => request('descripcion'),
            'fechainicioconvenio'      => request('inicio'),
            'fechafinconvenio' => request('fin'),
            'archivoconvenio' => $name
        ]);
        $path   =   "convenios/";

        $file->storeAs($path, $name);

        // redirect
        return redirect('convenios');

    }

    public function descargar(Convenio $convenio)
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(storage_path('app/convenios/').$convenio->archivoconvenio, 200, $headers );
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
            'descripcion'    => 'required',
            'inicio'       => 'required',
            'fin'       => 'required',
            'archivo'       => 'required'
        );
        $this->validate(request(), $rules);

        $file  =   $request->file('archivo');

        $name = request('id').'.'.$file->getClientOriginalExtension();

        // store
        Convenio::updateOrCreate(['idconvenio'  => $id], [
            'idsede'       => request('sede'),
            'idempresa'       => request('empresa'),
            'descripcionconvenio'      => request('descripcion'),
            'fechainicioconvenio'      => request('inicio'),
            'fechafinconvenio' => request('fin'),
            'archivoconvenio' => $name
        ]);
        $path   =   "convenios/";
        Storage::disk('convenios')->delete($name);
        $file->storeAs($path, $name);

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
