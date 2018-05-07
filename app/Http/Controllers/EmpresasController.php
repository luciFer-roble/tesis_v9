<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresasController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'nombre'       => 'required',
            'direccion'    => 'required',
            'sector'       => 'required',
            'telefono'     => 'required'
        );
        $this->validate(request(), $rules);


            // store
            Empresa::create([
                'nombreempresa'       => request('nombre'),
                'direccionempresa'      => request('direccion'),
                'sectorempresa'      => request('sector'),
                'telefonoempresa' => request('telefono')
            ]);


            // redirect
            return redirect('empresas');

    }


    public function show(Empresa $empresa)
    {
        return view('empresas.show')->with('empresa', $empresa);

    }


    public function edit(Empresa $empresa)
    {

        return view('empresas.edit')->with('empresa', $empresa);
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'nombre'       => 'required',
            'direccion'    => 'required',
            'sector'       => 'required',
            'telefono'     => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Empresa::updateOrCreate(['idempresa'  => $id], ['nombreempresa'       => request('nombre'),
            'direccionempresa'      => request('direccion'),
            'sectorempresa'      => request('sector'),
            'telefonoempresa' => request('telefono')
        ]);


        // redirect
        return redirect('empresas');
    }


    public function destroy($empresa)
    {
        Empresa::find($empresa)
            ->delete();

        return redirect('empresas');
    }
}
