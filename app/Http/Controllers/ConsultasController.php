<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\PeriodoAcademico;
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
    public function listarselect1(Request $request)
    {
        if($request->criterio == 'empresa'){
            $lista = Empresa::all();
        }
        else{
            $lista = PeriodoAcademico::with('facultad')->get();
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
            $practicas =DB::table('practica')
                ->join('estudiante', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
                ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
                ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
                ->where('practica.idperiodoacademico', '=', $request->parametro)->get();
        }
        return $practicas;
    }
}
