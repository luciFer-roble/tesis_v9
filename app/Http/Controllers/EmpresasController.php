<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.show')->with('empresa', $empresa);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {

        return view('empresas.edit')->with('empresa', $empresa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa)
    {
        Empresa::find($empresa)
            ->delete();

        return redirect('empresas');
    }
}
