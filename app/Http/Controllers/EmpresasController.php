<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\Sede;
use Illuminate\Http\Request;
use App\Empresa;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $convenios = Convenio::with('sede')->get();
        $empresas = Empresa::all();

        return view('empresas.index', compact('empresas', 'convenios'));
    }
   /* public function index2()
    {
        $empresas = DB::table('empresa')
            ->leftJoin('convenio', 'empresa.idempresa', '=', 'convenio.idempresa')
            ->leftJoin('sede', 'convenio.idsede', '=', 'sede.idsede')
        ->get();
        return view('empresas.coordinador.index', compact('empresas'));
    }*/

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
            'telefono'     => 'required',
            'tipo'     => 'required'
        );
        $this->validate(request(), $rules);


            // store
            Empresa::create([
                'nombreempresa'       => request('nombre'),
                'direccionempresa'      => request('direccion'),
                'sectorempresa'      => request('sector'),
                'telefonoempresa' => request('telefono'),
                'tipoempresa' => request('tipo')
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
            'telefono'     => 'required',
            'tipo'     => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Empresa::updateOrCreate(['idempresa'  => $id], [
            'nombreempresa'       => request('nombre'),
            'direccionempresa'      => request('direccion'),
            'sectorempresa'      => request('sector'),
            'telefonoempresa' => request('telefono'),
            'tipoempresa' => request('tipo')
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
