<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\PeriodoAcademico;
use App\Practica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
    public function descarga1(PeriodoAcademico $periodo)
    {
        //var_dump($periodo->descripcionperiodoacademico); exit();


        /*foreach ($estudiantes as $estudiante){
            $praticas = Practica::where('idestudiante', '=', $estudiante->idestudiante)->get();
        }*/
        Excel::create('ReportePeriodo'.$periodo->nombreperiodo, function ($excel) use($periodo){
           $excel->sheet($periodo->nombreperiodo, function ($sheet) use ($periodo){
               $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                   ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                   ->groupBy('estudiante.idestudiante')
                   ->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
                   ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)
                   ->havingRaw('SUM(practica.horaspractica) >= 120')
                   ->get();

               foreach ($estudiantes as $estudiante){
                   $row = [];
                   $row[0] = $estudiante->carrea->escuela->facultad->nombrefacultad;
                   $row[1] = $estudiante->carrera->nombrecarrera;
                   $row[2] = $estudiante->cedulaestudiante;
                   $row[3] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                   foreach ($estudiante->practica as $practica){
                       $row[4] = $practica->fechainiciopractica;
                   }
                   $sheet->appendRow($row);

               }
           });
        })->export('xls');

        return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }
}
