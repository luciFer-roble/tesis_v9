<?php

namespace App\Http\Controllers;

use App\Escuela;
use App\Practica;
use App\Profesor;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class ProfesoresController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $profesores = Profesor::all();
        $escuelas = Escuela::all();
        $practicas = Practica::all();
        return view('profesores.index', compact('profesores','escuelas','practicas'));
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $escuelas =Escuela::all();
        return view('profesores.create')->with(compact('escuelas'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'escuela'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'correo'    => 'required',
            'oficina'    => 'required',
            'celular'    => 'required',
            'cedula'    => 'required'
        );
        $this->validate(request(), $rules);

        $name= request('nombre1').' '.request('apellido1');
        $user = User::create([
            'name'     => $name,
            'email'    => request('correo'),
            'password' => bcrypt(request('cedula')),
        ]);
        $user->roles()->attach(Role::where('name','=', 'prof')->first());
        $iduser=$user->id;

        // store
        Profesor::create([
            'idprofesor'       => request('id'),
            'idescuela'       => request('escuela'),
            'nombre1profesor'      => request('nombre1'),
            'nombre2profesor'      => request('nombre2'),
            'apellido1profesor'      => request('apellido1'),
            'apellido2profesor'      => request('apellido2'),
            'correoprofesor'      => request('correo'),
            'oficinaprofesor'      => request('oficina'),
            'celularprofesor'      => request('celular'),
            'iduser'=>$iduser
        ]);


        // redirect
        return redirect('profesores');

    }


    public function show(Profesor $profesor)
    {
        return view('profesores.show')->with('profesor', $profesor);

    }


    public function edit(Profesor $profesor, Request $request)
    {

        $request->user()->authorizeRoles(['admin']);
        $escuelas =Escuela::all();
        return view('profesores.edit')->with(compact('profesor', 'escuelas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'escuela'       => 'required',
            'nombre1'       => 'required',
            'nombre2'    => 'required',
            'apellido1'    => 'required',
            'apellido2'    => 'required',
            'correo'    => 'required',
            'oficina'    => 'required',
            'celular'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Profesor::updateOrCreate(['idprofesor'  => $id], [
            'idescuela'       => request('escuela'),
            'nombre1profesor'      => request('nombre1'),
            'nombre2profesor'      => request('nombre2'),
            'apellido1profesor'      => request('apellido1'),
            'apellido2profesor'      => request('apellido2'),
            'correoprofesor'      => request('correo'),
            'oficinaprofesor'      => request('oficina'),
            'celularprofesor'      => request('celular')
        ]);


        // redirect
        return redirect('profesores');
    }


    public function destroy($profesor)
    {
        Profesor::find($profesor)
            ->delete();

        return redirect('profesores');
    }
}
