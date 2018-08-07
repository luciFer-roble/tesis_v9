@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <h1>PRACTICAS</h1></div>

                    <div class="btn-group mr-2">
                        <input type="button" onClick="location.href = 'practicas/create'"
                               class="btn btn-sm btn-outline-success" value="DESCARGAR"/>
                    </div>

                </div>
                `
            </div>
            <div class="card-body" id="app">

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th >Cedula</th>
                                <th >Nombre</th>
                                <th >Celular</th>
                                <th >Correo</th>
                                <th >Facultad</th>
                                <th >Carrera</th>
                                <th >Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($estudiantes as $estudiante)
                            <tr is="estudiante-item" :estudiante="{{ $estudiante }}" carrera="{{ $estudiante->carrera->nombrecarrera }}"
                            facultad="{{ $estudiante->carrera->escuela->facultad->nombrefacultad }}"></tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop