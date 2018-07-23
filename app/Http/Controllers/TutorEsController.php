<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\TutorE;
use App\Empresa;

class TutorEsController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tutores = TutorE::all();
        return view('tutores.index', compact('tutores'));
    }

    public function indexfrom(Empresa $empresa)
    {
        $tutores = TutorE::all()->where('idempresa', '=' , $empresa->idempresa );
        return view('tutores.index', compact('tutores'));
    }

    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'coord']);
        $empresas =Empresa::all();
        return view('tutores.create')->with(compact('empresas'));
    }
    public function createfrom(Empresa $empresa)
    {
        $empresas =Empresa::all();
        return view('tutores.create')->with(compact('empresa', 'empresas'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'empresa'       => 'required',
            'nombre'       => 'required',
            'apellido'    => 'required',
            'celular'       => 'required',
            'correo'     => 'required',
            'cedula'    => 'required'
        );
        $this->validate(request(), $rules);

        $name= request('nombre').' '.request('apellido');
        $user = User::create([
            'name'     => $name,
            'email'    => request('correo'),
            'password' => bcrypt(request('cedula')),
        ]);
        $user->roles()->attach(Role::where('name','=', 'tut')->first());
        $iduser=$user->id;

        // store
        TutorE::create([
            'idempresa'       => request('empresa'),
            'nombretutore'       => request('nombre'),
            'apellidotutore'      => request('apellido'),
            'celulartutore'      => request('celular'),
            'correotutore' => request('correo'),
            'iduser'=> $iduser
        ]);


        // redirect
        return redirect('tutores');

    }


    public function show(TutorE $tutore)
    {
        return view('tutores.show')->with('tutore', $tutore);

    }


    public function edit(TutorE $tutore)
    {
        $empresas =Empresa::all();
        return view('tutores.edit')->with(compact('tutore', 'empresas'));
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'empresa'       => 'required',
            'nombre'       => 'required',
            'apellido'    => 'required',
            'celular'       => 'required',
            'correo'     => 'required'
        );
        $this->validate(request(), $rules);


        // store
        TutorE::updateOrCreate(['idtutore'  => $id], [
            'idempresa'       => request('empresa'),
            'nombretutore'       => request('nombre'),
            'apellidotutore'      => request('apellido'),
            'celulartutore'      => request('celular'),
            'correotutore' => request('correo')
        ]);


        // redirect
        return redirect('tutores');
    }


    public function destroy($tutore)
    {
        TutorE::find($tutore)
            ->delete();

        return redirect('tutores');
    }
}
