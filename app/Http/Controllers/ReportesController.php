<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Nivel;
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
        $niveles = Nivel::all();
        return view('reportes.index', compact('periodos', 'niveles'));
    }
    public function reporte1(Request $request)
    {
        $periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            /*->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
            ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)*/
            ->havingRaw('SUM(practica.horaspractica) >= 120')
            ->havingRaw("max(practica.fechafinpractica) >= '".$periodo->fechainicioperiodoacademico."'")
            ->havingRaw("max(practica.fechafinpractica) <= '".$periodo->fechafinperiodoacademico."'")
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
            ->where('practica.idperiodoacademico','>=',$periodo->idperiodoacademico)
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
                    ->where('practica.idperiodoacademico','>=',$periodo->idperiodoacademico)
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

    public function reporte4(Request $request)
    {
        //$periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $tipoempresa = request('tipoempresa');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->groupBy('estudiante.idestudiante')
            ->where('empresa.tipoempresa', '=', $tipoempresa)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte4', compact('estudiantes', 'tipoempresa'));
    }
    public function descargaexcelr4($tipoempresa)
    {

        Excel::create('Reporte'.$tipoempresa, function ($excel) use($tipoempresa){
            $excel->sheet('Reporte', function ($sheet) use ($tipoempresa){
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
                $titulo = 'REPORTE DE PRACTICAS DE INTITUCINES TIPO '.$tipoempresa;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->groupBy('estudiante.idestudiante')
                    ->where('empresa.tipoempresa', '=', $tipoempresa)
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

    public function reporte5(Request $request)
    {
        //$periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $sector = request('sector');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->groupBy('estudiante.idestudiante')
            ->where('empresa.sectorempresa', '=', $sector)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte5', compact('estudiantes', 'sector'));
    }
    public function descargaexcelr5($sector)
    {

        Excel::create('ReportePPEmpresa'.$sector, function ($excel) use($sector){
            $excel->sheet('Reporte', function ($sheet) use ($sector){
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
                $titulo = 'REPORTE DE PRACTICAS DE INTITUCINES DEL SECTOR '.$sector;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->leftJoin('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->leftJoin('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->groupBy('estudiante.idestudiante')
                    ->where('empresa.sectorempresa', '=', $sector)
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

    public function reporte6(Request $request)
    {
        $nivel = Nivel::where('idnivel', '=', request('nivel'))->first();
        //$nivel = request('nivel');

        $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
            ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->groupBy('estudiante.idestudiante')
            ->where('practica.idnivel','=',$nivel->idnivel)
            ->get();
        //var_dump($tipopractica); exit();

        return view('reportes.reporte6', compact('estudiantes', 'nivel'));
    }
    public function reporte2p(Request $request)
    {
        $periodo = PeriodoAcademico::where('idperiodoacademico', '=', request('periodor1'))->first();
        $practicas = Practica::where('practica.idperiodoacademico','=',$periodo->idperiodoacademico)->get();
        return view('reportes.reporte2p', compact('practicas', 'periodo'));
    }
    public function reporte3p(Request $request)
    {
        $tipopractica = request('tipopractica');
        $practicas = Practica::where('practica.tipopractica','=',$tipopractica)->get();
        return view('reportes.reporte3p', compact('practicas', 'tipopractica'));
    }
    public function reporte4p(Request $request)
    {
        $tipoempresa = request('tipoempresa');
        $practicas = DB::table('practica')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.tipoempresa','=',$tipoempresa)->get();
        return view('reportes.reporte4p', compact('practicas', 'tipoempresa'));
    }
    public function reporte5p(Request $request)
    {
        $sectorempresa = request('sector');
        $practicas = DB::table('practica')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.sectorempresa','=',$sectorempresa)->get();
        return view('reportes.reporte5p', compact('practicas', 'sectorempresa'));
    }
    public function reporte6p(Request $request)
    {
        $nivel = Nivel::where('idnivel', '=', request('nivel'))->first();
        $practicas = Practica::where('practica.idnivel','=',$nivel->idnivel)->get();
        return view('reportes.reporte6p', compact('practicas', 'nivel'));
    }
    public function descargaexcelr6(Nivel $nivel)
    {

        Excel::create('ReporteNivel'.$nivel->nombrenivel, function ($excel) use($nivel){
            $excel->sheet('Reporte', function ($sheet) use ($nivel){
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
                $titulo = 'REPORTE DE PRACTICAS DE ESTUDIANTES QUE CURSABAN EL NIVEL '.$nivel->nombrenivel;
                //var_dump($periodo->fechainicioperiodoacademico); exit();

                $estudiantes = Estudiante::select(DB::raw('estudiante.*, SUM(practica.horaspractica) as horasestudiante'))
                    ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->groupBy('estudiante.idestudiante')
                    ->where('practica.idnivel', '=', $nivel->idnivel)
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
