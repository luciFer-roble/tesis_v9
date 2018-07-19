<?php

namespace App\Http\Controllers;

use App\Formato;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FormatosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

        $file  =   $request->file('archivo');

        $name = request('id').'.'.$file->getClientOriginalExtension();


        // store
        TipoDocumento::create([
            'idtipodocumento'       => request('id'),
            'descripciontipodocumento'      => request('descripcion')
        ]);
        Formato::create([
            'idtipodocumento'       => request('id'),
            'archivoformato'      => $name
        ]);

        $path   =   "formatos/";

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

    public function descargar(Formato $formato)
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(storage_path('app/formatos/').$formato->archivoformato, 200, $headers );
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'descripcion'       => 'required'
        );
        $this->validate(request(), $rules);
        $file  =   $request->file('archivo');

        if($file<>null){
            $name = request('id').'.'.$file->getClientOriginalExtension();
            $nameorigin= DB::table('formato')->select('archivoformato')->where('idtipodocumento', $id)->first();

            // store
            TipoDocumento::updateOrCreate(['idtipodocumento'  => $id], [
                'descripciontipodocumento'      => request('descripcion')
            ]);/*
        Formato::updateOrCreate(['idtipodocumento'  => $id], [
            'archivoformato'      => request('archivo')
        ]);*/
            DB::table('formato')
                ->where('idtipodocumento', $id)
                ->update(['archivoformato' => $name]);

            $path   =   "formatos/";
            Storage::disk('formatos')->delete($nameorigin->archivoformato);
            $file->storeAs($path, $name);
        }


        // redirect
        return redirect('formatos');
    }


    public function destroy($formato)
    {
        Formato::find($formato)
            ->delete();

        return true;
    }
}
