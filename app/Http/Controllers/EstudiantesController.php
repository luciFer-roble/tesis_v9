<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Escuela;
use App\Estudiante;
use App\Facultad;
use App\Practica;
use App\Profesor;
use App\Role;
use App\Sede;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EstudiantesController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->hasRole('prof')){
            $profesor = Profesor::all()->where('iduser','=',Auth::user()->id)->first();
            $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->groupBy('estudiante.idestudiante')
                ->where('practica.idprofesor','=',$profesor->idprofesor)
                ->get();
        }
        else{
            $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->get();

        }
        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
        return view('estudiantes.index', compact('estudiantes', 'carreras', 'escuelas', 'facultades', 'sedes'));
    }

    public function create(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);
        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
        return view('estudiantes.create')->with(compact('carreras', 'escuelas', 'facultades', 'sedes'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'carrera'       => 'required',
            'cedula'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'tipo'    => 'required',
            'celular'    => 'required',
            'correo'    => 'required',
            'fechanacimiento'    => 'required',
            'genero'    => 'required'
        );
        $this->validate(request(), $rules);

        $name= request('nombre1').' '.request('apellido1');
        $user = User::create([
            'name'     => $name,
            'email'    => request('correo'),
            'password' => bcrypt(request('cedula')),
        ]);
        $user->roles()->attach(Role::where('name','=', 'est')->first());
        $iduser=$user->id;
        // store
        Estudiante::create([
            'idestudiante'       => request('cedula'),
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombre1estudiante'      => request('nombre1'),
            'nombre2estudiante'      => request('nombre2'),
            'apellido1estudiante'      => request('apellido1'),
            'apellido2estudiante'      => request('apellido2'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero'),
            'iduser'=>$iduser
        ]);



        // redirect
        return redirect('estudiantes');

    }


    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show')->with('estudiante', $estudiante);

    }


    public function edit(Estudiante $estudiante,Request $request)
    {

        $request->user()->authorizeRoles(['admin']);
        $carreras =Carrera::all();
        $escuelas =Escuela::all();
        $facultades =Facultad::all();
        $sedes =Sede::all();
        return view('estudiantes.edit')->with(compact('estudiante', 'carreras', 'escuelas', 'facultades', 'sedes'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'carrera'       => 'required',
            'cedula'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'tipo'    => 'required',
            'celular'    => 'required',
            'correo'    => 'required',
            'fechanacimiento'    => 'required',
            'genero'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Estudiante::updateOrCreate(['idestudiante'  => $id], [
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombre1estudiante'      => request('nombre1'),
            'nombre2estudiante'      => request('nombre2'),
            'apellido1estudiante'      => request('apellido1'),
            'apellido2estudiante'      => request('apellido2'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero')
        ]);


        // redirect
        return redirect('estudiantes');
    }


    public function destroy($estudiante)
    {
        Estudiante::find($estudiante)
            ->delete();

        return redirect('estudiantes');
    }
}
