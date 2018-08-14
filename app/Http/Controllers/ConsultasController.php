<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Nivel;
use App\PeriodoAcademico;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{

    public function listarasignaturas(Request $carrera)
    {
        $asignaturas = DB::table('carrera')
            ->join('mallascurricular', 'carrera.idcarrera', '=', 'mallascurricular.idcarrera')
            ->join('nivel', 'mallascurricular.idmalla', '=', 'nivel.idmalla')
            ->join('asignatura', 'nivel.idnivel', '=', 'asignatura.idnivel')
            ->select('asignatura.idasignatura',  'asignatura.nombreasignatura')
            ->where('carrera.idcarrera', '=', $carrera->idcarrera)
            ->get();
        return $asignaturas;

    }

    public function totaldocs(){
        return (string)DB::table('tipodocumento')->count();
    }

    public function todaslaspracticas(){
        $practicas =DB::table('practica')
            ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->get();
        return $practicas;
    }

    public function consultarpracticas(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where($request->criterio.'.nombre1'.$request->criterio, 'like', $request->parametro.'%')->get();
        return $practicas;

    }

    public function consultarpracticasporestudiante(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('practica.idestudiante', '=', request('idestudiante'))->get();
        return $practicas;

    }
    public function consultarpracticasporperiodo(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('practica.idperiodoacademico', '=', request('idperiodo'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }
    public function consultarpracticasportipopractica(Request $request)
{
    $practicas =DB::table('practica')
        ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
        ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
        ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
        ->where('practica.tipopractica', '=', request('tipopractica'))
        ->where('practica.idestudiante', '=', request('idestudiante'))
        ->get();
    return $practicas;

}

    public function listarselect1(Request $request)
    {
        if($request->criterio == 'empresa'){
            $lista = Empresa::all();
        }
        else{
            if ($request->criterio == 'periodo'){
                $lista = PeriodoAcademico::with('facultad')->get();
            }
            else{
                $lista = Nivel::all();
            }
        }
        return $lista;
    }
    public function consultarpracticas2(Request $request){
        if($request->criterio == 'empresa'){
            $practicas =DB::table('practica')
                ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                ->where('empresa.idempresa', '=', $request->parametro)->get();
        }
        else{
            if ($request->criterio == 'periodo'){
                $practicas =DB::table('practica')
                    ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                    ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->where('practica.idperiodoacademico', '=', $request->parametro)->get();
            }
            else{
                $estudiantes = DB::select("select estudiante.idestudiante
                from estudiante
                join estudiantexasignatura on estudiantexasignatura.idestudiante = estudiante.idestudiante
                join asignatura on estudiantexasignatura.idasignatura = asignatura.idasignatura
                join nivel on nivel.idnivel = asignatura.idnivel
                group by estudiante.idestudiante
                having min(nivel.idnivel) = '".$request->parametro."'");
                $lista = collect($estudiantes)->map(function($x){ return (array) $x; })->toArray();

                $practicas =DB::table('practica')
                    ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                    ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                    ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                    ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                    ->whereIn('estudiante.idestudiante', $lista)->get();
            }
        }
        return $practicas;
    }
}
