<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\PeriodoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function index()
    {
        $periodos = PeriodoAcademico::all();
        return view('reportes.index', compact('periodos'));
    }
    public function reporte1(Request $request)
    {
        $periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
            ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)
            ->havingRaw('SUM(practica.horaspractica) >= 120')
            ->get();

        return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }
}
