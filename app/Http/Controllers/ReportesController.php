<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\PeriodoAcademico;
use App\Practica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Scalar\String_;

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

    public function descargaexcelr1(PeriodoAcademico $periodo)
    {

        Excel::create('Reporte-finalizacionen-Periodo'.$periodo->nombreperiodoacademico, function ($excel) use($periodo){
           $excel->sheet('Reporte', function ($sheet) use ($periodo){
               $sheet->mergeCells('A1:I1');
               $sheet->mergeCells('A2:I2');
               $sheet->cells('A1:I1', function($cells) {
                   $cells->setFontWeight('bold');
                   $cells->setFontSize(16);
               });
               $sheet->cells('A2:K2', function($cells) {
                   $cells->setFontWeight('bold');
                   $cells->setFontSize(18);
               });
               $sheet->cells('A4:K4', function($cells) {

                   $cells->setBackground('#B1A0C7');
                   $cells->setFontWeight('bold');

               });
               $sheet->setFontFamily('Calibri');
               $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICA PREPROFESIONALES'.$periodo->nombreperiodoacademico;
                //var_dump($periodo->fechainicioperiodoacademico); exit();
               $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                   ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                   ->groupBy('estudiante.idestudiante')
                   ->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
                   ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)
                   ->havingRaw('SUM(practica.horaspractica) >= 120')
                   ->get();
               $sheet->appendRow(1, array(
                   'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
               ));
               $sheet->appendRow(2, array(
                   $titulo
               ));
               $cabecera = [];
               $cabecera[0]= 'No.';
               $cabecera[1]= 'Unidad Academica';
               $cabecera[2]= 'Carrera';
               $cabecera[3]= 'Identificacion';
               $cabecera[4]= 'Apellidos y Nombres del Estudiante';
               $cabecera[5]= 'Fecha de Inicio Practica 1';
               $cabecera[6]= 'Fecha de Finalizacion Practica 1';
               $cabecera[7]= 'No. de Horas Practica 1';
               $cabecera[8]= 'Centro de Practicas 1';
               $cabecera[9]= 'Tipo de Intitucion 1';
               $cabecera[10]= 'Sector Institucion 1';

               $sheet->appendRow(4, $cabecera);
               $numero = 1;
               foreach ($estudiantes as $estudiante){


                   $practicas = Practica::where('idestudiante', '=', $estudiante->idestudiante)->get();
                   $row = [];
                   $row[0] = $numero++;
                   $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                   $row[2] = $estudiante->carrera->nombrecarrera;
                   $row[3] = $estudiante->cedulaestudiante;
                   $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                   $columna =5;
                   foreach ($practicas as $practica){
                       $row[$columna++] = $practica->fechainiciopractica;
                       $row[$columna++] = $practica->fechafinpractica;
                       $row[$columna++] = $practica->horaspractica;
                       $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                       $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                       $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                   }
                   $sheet->appendRow($row);
               }

               $sheet->setBorder('A4:K'.($numero+3), 'thin');
           });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte2(Request $request)
    {
        $periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->whereDate('fechainiciopractica','>=',$periodo->fechainicioperiodoacademico)
            ->whereDate('fechainiciopractica','<=',$periodo->fechafinperiodoacademico)
            ->get();

        return view('reportes.reporte2', compact('estudiantes', 'periodo'));
    }
    public function descargaexcelr2(PeriodoAcademico $periodo)
    {

        Excel::create('ReportePeriodo'.$periodo->nombreperiodoacademico, function ($excel) use($periodo){
            $excel->sheet('Reporte', function ($sheet) use ($periodo){
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->cells('A1:I1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A2:K2', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(18);
                });
                $sheet->cells('A4:K4', function($cells) {

                    $cells->setBackground('#B1A0C7');
                    $cells->setFontWeight('bold');

                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICA PREPROFESIONALES'.$periodo->nombreperiodoacademico;
                //var_dump($periodo->fechainicioperiodoacademico); exit();
                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->groupBy('estudiante.idestudiante')
                    ->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
                    ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)
                    ->havingRaw('SUM(practica.horaspractica) >= 120')
                    ->get();
                $sheet->appendRow(1, array(
                    'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
                ));
                $sheet->appendRow(2, array(
                    $titulo
                ));
                $cabecera = [];
                $cabecera[0]= 'No.';
                $cabecera[1]= 'Unidad Academica';
                $cabecera[2]= 'Carrera';
                $cabecera[3]= 'Identificacion';
                $cabecera[4]= 'Apellidos y Nombres del Estudiante';
                $cabecera[5]= 'Fecha de Inicio Practica 1';
                $cabecera[6]= 'Fecha de Finalizacion Practica 1';
                $cabecera[7]= 'No. de Horas Practica 1';
                $cabecera[8]= 'Centro de Practicas 1';
                $cabecera[9]= 'Tipo de Intitucion 1';
                $cabecera[10]= 'Sector Institucion 1';

                $sheet->appendRow(4, $cabecera);
                $numero = 1;
                foreach ($estudiantes as $estudiante){


                    $practicas = Practica::where('idestudiante', '=', $estudiante->idestudiante)->get();
                    $row = [];
                    $row[0] = $numero++;
                    $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                    $row[2] = $estudiante->carrera->nombrecarrera;
                    $row[3] = $estudiante->cedulaestudiante;
                    $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                    $columna =5;
                    foreach ($practicas as $practica){
                        $row[$columna++] = $practica->fechainiciopractica;
                        $row[$columna++] = $practica->fechafinpractica;
                        $row[$columna++] = $practica->horaspractica;
                        $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                        $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                        $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                    }
                    $sheet->appendRow($row);
                }

                $sheet->setBorder('A4:K'.($numero+3), 'thin');
            });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }

    public function reporte3(Request $request)
    {
        //$periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $tipopractica = request('tipopractica');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->where('practica.tipopractica', '=', $tipopractica)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte3', compact('estudiantes', 'tipopractica'));
    }
    public function descargaexcelr3($tipopractica)
    {

        Excel::create('Reporte'.$tipopractica, function ($excel) use($tipopractica){
            $excel->sheet('Reporte', function ($sheet) use ($tipopractica){
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->cells('A1:I1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A2:K2', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(18);
                });
                $sheet->cells('A4:K4', function($cells) {

                    $cells->setBackground('#B1A0C7');
                    $cells->setFontWeight('bold');

                });
                $sheet->setFontFamily('Calibri');
                $sheet->setFontSize(9);
                $titulo = 'REPORTE DE PRACTICAS TIPO '.$tipopractica;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->groupBy('estudiante.idestudiante')
                    ->where('practica.tipopractica', '=', $tipopractica)
                    ->get();
                $sheet->appendRow(1, array(
                    'PONTIFICIA UNIVERSIDAD CATOLICA DEL ECUADOR'
                ));
                $sheet->appendRow(2, array(
                    $titulo
                ));
                $cabecera = [];
                $cabecera[0]= 'No.';
                $cabecera[1]= 'Unidad Academica';
                $cabecera[2]= 'Carrera';
                $cabecera[3]= 'Identificacion';
                $cabecera[4]= 'Apellidos y Nombres del Estudiante';
                $cabecera[5]= 'Fecha de Inicio Practica 1';
                $cabecera[6]= 'Fecha de Finalizacion Practica 1';
                $cabecera[7]= 'No. de Horas Practica 1';
                $cabecera[8]= 'Centro de Practicas 1';
                $cabecera[9]= 'Tipo de Intitucion 1';
                $cabecera[10]= 'Sector Institucion 1';

                $sheet->appendRow(4, $cabecera);
                $numero = 1;
                foreach ($estudiantes as $estudiante){


                    $practicas = Practica::where('idestudiante', '=', $estudiante->idestudiante)->get();
                    $row = [];
                    $row[0] = $numero++;
                    $row[1] = $estudiante->carrera->escuela->facultad->nombrefacultad;
                    $row[2] = $estudiante->carrera->nombrecarrera;
                    $row[3] = $estudiante->cedulaestudiante;
                    $row[4] = $estudiante->apellidosestudiante.' '.$estudiante->nombresestudiante;
                    $columna =5;
                    foreach ($practicas as $practica){
                        $row[$columna++] = $practica->fechainiciopractica;
                        $row[$columna++] = $practica->fechafinpractica;
                        $row[$columna++] = $practica->horaspractica;
                        $row[$columna++] = $practica->tutore->empresa->nombreempresa;
                        $row[$columna++] = $practica->tutore->empresa->tipoempresa;
                        $row[$columna++] = $practica->tutore->empresa->sectorempresa;
                    }
                    $sheet->appendRow($row);
                }

                $sheet->setBorder('A4:K'.($numero+3), 'thin');
            });
        })->export('xlsx');

        //return view('reportes.reporte1', compact('estudiantes', 'periodo'));
    }
}
