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
}
