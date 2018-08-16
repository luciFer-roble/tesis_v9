<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Estudiante;
use App\Nivel;
use App\PeriodoAcademico;
use App\Practica;
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

    public function consultarpracticasportipoempresa(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.tipoempresa', '=', request('tipoempresa'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }

    public function consultarpracticasporsector(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('empresa.sectorempresa', '=', request('sector'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }

    public function consultarpracticaspornivel(Request $request)
    {
        $practicas =DB::table('practica')
            ->join('profesor', 'practica.idprofesor', '=', 'profesor.idprofesor')
            ->join('tutore', 'practica.idtutore', '=', 'tutore.idtutore')
            ->join('empresa', 'empresa.idempresa', '=', 'tutore.idempresa')
            ->where('practica.idnivel', '=', request('nivel'))
            ->where('practica.idestudiante', '=', request('idestudiante'))
            ->get();
        return $practicas;

    }

    public function totalpracticas()
    {
        return Practica::all()->count();
    }
    public function totalportipo(Request $request)
    {
        return Practica::where('tipopractica','=', Request('tipo'))->count();
    }

    public function totalesporperiodo(){
        $periodos = PeriodoAcademico::all();
        $respuesta=array();
        foreach ($periodos as $periodo){

            $total = Estudiante::select(DB::raw('count(distinct(estudiante.idestudiante)) as totalestudiantes'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->groupBy('estudiante.idestudiante')
                /*->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
                ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)*/
                ->havingRaw('SUM(practica.horaspractica) >= 120')
                ->havingRaw("max(practica.fechafinpractica) >= '".$periodo->fechainicioperiodoacademico."'")
                ->havingRaw("max(practica.fechafinpractica) <= '".$periodo->fechafinperiodoacademico."'")
                ->first();
            //var_dump((string)$total);
                $respuesta[] = $total;
        }
        return $respuesta;
    }
    public  function totalperiodos(){

        $periodos = PeriodoAcademico::all();
        return $periodos;
    }

    public function totalespornivel(){
        $niveles = Nivel::all();
        $respuesta=array();
        foreach ($niveles as $nivel){

            $total = Estudiante::select(DB::raw('count(distinct(estudiante.idestudiante)) as totalestudiantes'))
                ->leftJoin('practica', 'practica.idestudiante', '=', 'estudiante.idestudiante')
                ->groupBy('estudiante.idestudiante')
                /*->whereDate('fechafinpractica','>=',$periodo->fechainicioperiodoacademico)
                ->whereDate('fechafinpractica','<=',$periodo->fechafinperiodoacademico)*/
                ->havingRaw('SUM(practica.horaspractica) >= 120')
                ->havingRaw("practica.idnivel >= '".$nivel->idnivel."'")
                ->first();
            //var_dump((string)$total);
            $respuesta[] = $total;
        }
        return $respuesta;
    }

    public function totalesporperiodo2(){
        $periodos = PeriodoAcademico::all();
        $respuesta=array();
        foreach ($periodos as $periodo){

            $total = Practica::select(DB::raw(' count(distinct(practica.idpractica)) as totalpracticas'))
                ->groupBy('practica.idperiodoacademico')
                //->where("practica.idperiodoacademico" ,'=', $periodo->idperiodoacademico)
                ->havingRaw("practica.idperiodoacademico = '".$periodo->idperiodoacademico."'")
                ->first();
            //var_dump((string)$total);
            $respuesta[] = $total;
        }
        return $respuesta;
    }
    public  function totalniveles(){
        $niveles = Nivel::all();
        return $niveles;
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
