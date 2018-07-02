<?php

namespace App\Http\Controllers;

use App\Practica;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function index(Practica $practica)
    {
        return view('actividades.index', compact('practica'));
    }
}
