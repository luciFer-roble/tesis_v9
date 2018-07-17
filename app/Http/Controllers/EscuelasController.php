<?php

namespace App\Http\Controllers;

use App\Escuela;
use App\Facultad;
use App\Sede;
use Illuminate\Http\Request;

class EscuelasController extends Controller
{
    public function index()
    {
        $escuelas = Escuela::all();
        return view('escuelas.index', compact('escuelas'));
    }

    public function create()
    {
        $facultades =Facultad::all();
        return view('escuelas.create')->with(compact('facultades'));
    }
    public function indexfrom(Facultad $facultad)
    {
        $escuelas = Escuela::all()->where('idfacultad', '=' , $facultad->idfacultad );
        return view('escuelas.index', compact('escuelas'));
    }
    public function indexfromsede(Sede $sede)
    {

        $facultades = Facultad::pluck('idfacultad')->where('idsede', '=' , $sede->idsede );
        $escuelas=Escuela::all()->whereIn('idfacultad',$facultades);
        /*$escuelas = DB::table('escuela')
            ->join('facultad', 'escuela.idfacultad', '=', 'facultad.idfacultad')
            ->join('sede', 'facultad.idfacultad', '=', $sede->idsede)
            ->select('escuela.*')
            ->get();*/
        return view('escuelas.index', compact('escuelas'));
    }
    public function createfrom(Facultad $facultad)
    {
        $facultades =Facultad::all();
        return view('escuelas.create')->with(compact('facultad', 'facultades'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'facultad'       => 'required',
            'nombre'       => 'required',
            'descripcion'       => 'required',
            'titulacion'    => 'required',
            'mision'    => 'required',
            'vision'    => 'required',
            'duracion'    => 'required',
            'modalidad'    => 'required',
            'campo'    => 'required',
            'titulo'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Escuela::create([
            'idescuela'       => request('id'),
            'idfacultad'       => request('facultad'),
            'nombreescuela'       => request('nombre'),
            'descripcionescuela'      => request('descripcion'),
            'titulacionescuela'      => request('titulacion'),
            'misionescuela'      => request('mision'),
            'visionescuela'      => request('vision'),
            'duracionescuela'      => request('duracion'),
            'modalidadescuela'      => request('modalidad'),
            'campoescuela'      => request('campo'),
            'tituloescuela'      => request('titulo')
        ]);


        // redirect
        return redirect('escuelas');

    }


    public function show(Escuela $escuela)
    {
        return view('escuelas.show')->with('escuela', $escuela);

    }


    public function edit(Escuela $escuela)
    {
        $facultades =Facultad::all();
        return view('escuelas.edit')->with(compact('escuela', 'facultades'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'facultad'       => 'required',
            'nombre'       => 'required',
            'descripcion'       => 'required',
            'titulacion'    => 'required',
            'mision'    => 'required',
            'vision'    => 'required',
            'duracion'    => 'required',
            'modalidad'    => 'required',
            'campo'    => 'required',
            'titulo'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Escuela::updateOrCreate(['idescuela'  => $id], [
            'idfacultad'       => request('facultad'),
            'nombreescuela'       => request('nombre'),
            'descripcionescuela'      => request('descripcion'),
            'titulacionescuela'      => request('titulacion'),
            'misionescuela'      => request('mision'),
            'visionescuela'      => request('vision'),
            'duracionescuela'      => request('duracion'),
            'modalidadescuela'      => request('modalidad'),
            'campoescuela'      => request('campo'),
            'tituloescuela'      => request('titulo')
        ]);


        // redirect
        return redirect('escuelas');
    }


    public function destroy($escuela)
    {
        Escuela::find($escuela)
            ->delete();

        return redirect('escuelas');
    }
}
