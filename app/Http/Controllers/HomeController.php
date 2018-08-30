<?php

namespace App\Http\Controllers;

use App\Nivel;
use App\PeriodoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('coord')){
            $periodos = PeriodoAcademico::all();
            $niveles = Nivel::all();
            return view('reportes.index', compact('periodos', 'niveles'));
        }else{
            return view('home');
        }
    }
}
