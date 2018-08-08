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
                        <h3>{{ $periodo->descripcionperiodoacademico }}</h3></div>

                    <div class="btn-group mr-2 float-right">
                        <input type="button" onClick="location.href = 'practicas/create'"
                               class="btn btn-sm btn-outline-danger" value="PDF"/>
                        <input type="button" onClick="location.href = 'practicas/create'"
                               class="btn btn-sm btn-outline-success" value="EXCEL"/>
                    </div>

                </div>
                `
            </div>
            <div class="card-body p-0 m-0" id="app">

                <div class="table-responsive">

                    <table class="table table-bordered p-0 m-0 border-0" id="dataTable" width="100%" style="table-layout: fixed;  display: table;">
                        <thead>
                            <tr>
                                <th  style="width:  12%" class="p-1 m-0">Identificacion</th>
                                <th  style="width:  16%" class="p-1 m-0">Apellidos y Nombres</th>
                                <th  style="width:  13%" class="p-1 m-0">Unidad Academica</th>
                                <th  style="width:  25%" class="p-1 m-0">Carrera</th>
                                <th  style="width:  13%" class="p-1 m-0">Celular</th>
                                <th  style="width:  14%" class="p-1 m-0">Correo</th>
                                <th  colspan="2"  style="width:  7.318912295584146%;" class="p-1 m-0">Horas</th>
                            </tr>
                        </thead>
                    </table>
                        @foreach($estudiantes as $estudiante)
                            <estudiante-item  :estudiante="{{ $estudiante }}" carrera="{{ $estudiante->carrera->nombrecarrera }}"
                                facultad="{{ $estudiante->carrera->escuela->facultad->nombrefacultad }}"></estudiante-item>
                        @endforeach
                </div>
            </div>
        </div>
    </div>


@stop