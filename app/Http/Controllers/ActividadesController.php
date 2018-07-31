<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Practica;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Practica $practica)
    {
        $actividades = Actividad::where('idpractica', '=' , $practica->idpractica )->orderBy('idactividad')->paginate(5);
        return view('actividades.index', compact('practica', 'actividades'));
    }
    public function store($practica, $total)
    {

        //echo $total; exit();
        // store
        for ($i = 0; $i < 5; $i++){

            Actividad::create([
                'idpractica'       => $practica,
                'semanaactividad'       => ($total + 1),
            ]);
        }


        // redirect
        return redirect('actividades/'.$practica.'/list?page='.($total+1));

    }
    public function update(Request $request, $id)
    {


        // store
        Actividad::updateOrCreate(['idactividad'  => $id], [
            'descripcionactividad'       => request('descripcion'),
            'fechaactividad'       => request('fecha'),
            'comentarioactividad'      => request('comentario'),
            'estadoactividad'      => request('estado'),
            'horasactividad'      => request('horas')
        ]);


        // redirect
        return true;
    }
}
