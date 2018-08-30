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
use Image;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

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
            'nombres'       => 'required',
            'apellidos'    => 'required',
            'tipo'    => 'required',
            'celular'    => 'required',
            'correo'    => 'required',
            'fechanacimiento'    => 'required',
            'genero'    => 'required'

        );
        $this->validate(request(), $rules);
        /*//SI SE CARGA UNA IMAGEN SE LA GUARDA EN LA CARPETA PUBLIC Y SU NOMBRE SERA LA CEDULA.JPG
        if($request->hasFile('foto'))
        {
            $image  =   $request->file('foto');

            $nameimage = request('cedula').'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path('/uploads/avatars/'.$nameimage));

        }
        //SI NO SE CARGA IMAGEN SE DEBERIA GUARDAR EL NOBRE DEL AVATAR POR DEFECTO: USER.JPG
        else{
            $nameimage="user.jpg";
        }*/
        $nameimage="user.jpg";
        $name= request('nombres').' '.request('apellidos');
        $user = User::create([
            'name'     => $name,
            'email'    => request('correo'),
            'password' => bcrypt(request('cedula')),
            'avatar' => $nameimage
        ]);
        $user->roles()->attach(Role::where('name','=', 'est')->first());
        $iduser=$user->id;
        // store
        Estudiante::create([
            'idestudiante'       => request('cedula'),
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombresestudiante'      => request('nombres'),
            'apellidosestudiante'      => request('apellidos'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero'),
            'iduser'=>$iduser
        ]);



        Flash::success('Ingresado Correctamente');
        // redirect
        return redirect('estudiantes');

    }
    public function descargar(Estudiante $estudiante)
    {
        $headers = ['Content-Type: application/zip','Content-Disposition: attachment; filename={$filename}'];
        return response()->download(storage_path('app/convenios/').$estudiante->fotoestudiante, 200, $headers );
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
            'cedula'       => 'required',
            'nombres'       => 'required',
            'apellidos'    => 'required',
            'tipo'    => 'required',
            'celular'    => 'required',
            'correo'    => 'required',
            'fechanacimiento'    => 'required'
        );
        $this->validate(request(), $rules);


        // store
        Estudiante::updateOrCreate(['idestudiante'  => $id], [
            'idcarrera'       => request('carrera'),
            'cedulaestudiante'       => request('cedula'),
            'nombresestudiante'      => request('nombres'),
            'apellidosestudiante'      => request('apellidos'),
            'tipoestudiante'      => request('tipo'),
            'correoestudiante'      => request('correo'),
            'celularestudiante'      => request('celular'),
            'fechanacimientoestudiante'      => request('fechanacimiento'),
            'generoestudiante'      => request('genero')
        ]);


        Flash::success('Actualizado Correctamente');
        // redirect
        return ['redirect' => route('estudiantes.index')];
    }


    public function destroy($estudiante)
    {
        Estudiante::find($estudiante)
            ->delete();

        return redirect('estudiantes');
    }
}
