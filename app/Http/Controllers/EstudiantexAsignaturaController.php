<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Carrera;
use App\Estudiante;
use App\EstudiantexAsignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudiantexAsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roba(Request $carrera)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Carrera $carrera, Estudiante $estudiante)
    {

        return view('estasignaturas.create',['idcarrera'=>$carrera->idcarrera, 'estudiante'=>$estudiante]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EstudiantexAsignatura  $estudiantexAsignatura
     * @return \Illuminate\Http\Response
     */
    public function show(EstudiantexAsignatura $estudiantexAsignatura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EstudiantexAsignatura  $estudiantexAsignatura
     * @return \Illuminate\Http\Response
     */
    public function edit(EstudiantexAsignatura $estudiantexAsignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EstudiantexAsignatura  $estudiantexAsignatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstudiantexAsignatura $estudiantexAsignatura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EstudiantexAsignatura  $estudiantexAsignatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstudiantexAsignatura $estudiantexAsignatura)
    {
        //
    }
}
