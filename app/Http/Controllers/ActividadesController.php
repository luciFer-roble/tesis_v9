<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Practica;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function index(Practica $practica)
    {
        $actividades = Actividad::where('idpractica', '=' , $practica->idpractica )->paginate(5);
        return view('actividades.index', compact('practica', 'actividades'));
    }
    public function store($practica, $total)
    {


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
}
