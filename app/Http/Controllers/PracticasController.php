<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\Empresa;
use App\Estudiante;
use App\PeriodoAcademico;
use App\Practica;
use App\Profesor;
use App\TutorE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function consultas(Request $request)
    {
        return view('practicas.consultas');
    }
    public function consultas2(Request $request)
    {
        return view('practicas.consultas2');
    }
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'est','prof','tut', 'coord']);

        if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('coord')){
            $practicas = Practica::all();
            return view('practicas.index', compact('practicas'));
        }
        if(Auth::user()->hasRole('est')){
            $estudiante = Estudiante::all()->where('iduser','=',Auth::user()->id)->first();
            $practicas = Practica::all()->where('idestudiante','=',$estudiante->idestudiante);
            return view('practicas.index', compact('practicas'));
        }
        if(Auth::user()->hasRole('prof')){
            $profesor = Profesor::all()->where('iduser','=',Auth::user()->id)->first();
            $practicas = Practica::all()->where('idprofesor','=',$profesor->idprofesor);
            return view('practicas.index', compact('practicas'));
        }
        if(Auth::user()->hasRole('tut')){
            $tutore = Tutore::all()->where('iduser','=',Auth::user()->id)->first();
            $practicas = Practica::all()->where('idtutore','=',$tutore->idtutore);
            return view('practicas.index', compact('practicas'));
        }
    }
    public function indexfrom(Profesor $profesor){
        $practicas = Practica::all()->where('idprofesor','=',$profesor->idprofesor);
        return view('practicas.index', compact('practicas'));

    }
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'coord']);
        $estudiantes =Estudiante::all();
        $empresasconvenio = Convenio::pluck('idempresa')->all();
        $empresas = Empresa::whereIn('idempresa', $empresasconvenio)->select('idempresa','nombreempresa')->get();
        $profesores = Profesor::all();
        $tutores = TutorE::all();
        $periodos = PeriodoAcademico::all();
        return view('practicas.create')->with(compact('estudiantes', 'profesores', 'empresas', 'tutores','periodos'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'estudiante'       => 'required',
            'profesor'       => 'required',
            'empresa'       => 'required',
            'tutore'    => 'required',
            'descripcion'    => 'required',
            'inicio'    => 'required',
            'tipo'    => 'required',
            'salario'    => 'required',
            'periodo'    => 'required'
        );
        $this->validate(request(), $rules);
        $activa='TRUE';


        // store
        Practica::create([
            'idestudiante'       => request('estudiante'),
            'idprofesor'      => request('profesor'),
            'idtutore'      => request('tutore'),
            'descripcionpractica'      => request('descripcion'),
            'fechainiciopractica'      => request('inicio'),
            'fechafinpractica'      => request('fin'),
            'tipopractica'      => request('tipo'),
            'salariopractica'      => request('salario'),
            'idperiodoacademico'      => request('periodo'),
            'horaspractica'      => request('horas'),
            'activapractica'      => $activa
        ]);


        // redirect
        return redirect('practicas');

    }


    public function show(Practica $practica)
    {
        return view('practicas.show')->with('practica', $practica);

    }


    public function edit(Practica $practica)
    {
        $estudiantes =Estudiante::all();
        $profesores = Profesor::all();
        $empresas = Empresa::all();
        $tutores = TutorE::all();
        $periodos = PeriodoAcademico::all();
        return view('practicas.edit')->with(compact('practica', 'estudiantes', 'profesores', 'empresas', 'tutores','periodos'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'estudiante'       => 'required',
            'profesor'       => 'required',
            'tutore'    => 'required',
            'inicio'    => 'required',
            'tipo'    => 'required',
            'salario'    => 'required',
            'horas'    => 'required',
            'periodo'    => 'required'
        );
        $this->validate(request(), $rules);
        $activa='TRUE';

        // store
        Practica::updateOrCreate(['idpractica'  => $id], [
            'idestudiante'       => request('estudiante'),
            'idprofesor'      => request('profesor'),
            'idtutore'      => request('tutore'),
            'descripcionpractica'      => request('descripcion'),
            'fechainiciopractica'      => request('inicio'),
            'fechafinpractica'      => request('fin'),
            'tipopractica'      => request('tipo'),
            'salariopractica'      => request('salario'),
            'idperiodoacademico'      => request('periodo'),
            'horaspractica'      => request('horas'),
            'activapractica'      => $activa
        ]);


        // redirect
        return redirect('practicas');
    }


    public function destroy($practica)
    {
        Practica::find($practica)
            ->delete();

        return redirect('practicas');
    }
}
