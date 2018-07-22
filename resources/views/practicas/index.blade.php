@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Practicas</li>
@endsection
@section('content')
        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <h1>PRACTICAS</h1></div>
                                @if(Auth::user()->hasRole('admin')or Auth::user()->hasRole('coord') )
                                    <div class="btn-group mr-2">
                                        <input type="button" onClick="location.href = 'practicas/create'" class="btn btn-sm btn-outline-success" value="NUEVA"></input>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Estudiante</th>
                                        <th>Empresa</th>
                                        <th>Tutor Academico</th>
                                        <th>Tutor Empresarial</th>
                                        <th>Tipo</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($practicas as $practica)
                                        <tr>
                                            <td class="p-1 m-0">{{ $practica->idpractica }}</td>
                                            <td class="p-1 m-0">
                                                <a  class="btn btn-link" href="{{ URL::to('estudiantes/' . $practica->idestudiante) }}">{{ $practica->estudiante->nombre1estudiante .' '. $practica->estudiante->apellido1estudiante }}</a></td>
                                            <td class="p-1 m-0">{{ $practica->tutore->empresa->nombreempresa }}</td>
                                            <td class="p-1 m-0">
                                                <a  class="btn btn-link" href="{{ URL::to('profesores/' . $practica->idprofesor) }}">
                                                    {{ $practica->profesor->nombre1profesor .' '. $practica->profesor->apellido1profesor }}</a></td>
                                            <td class="p-1 m-0">
                                                <a  class="btn btn-link" href="{{ URL::to('tutores/' . $practica->idtutore) }}">
                                                    {{ $practica->tutore->nombretutore .' '. $practica->tutore->apellidotutore }}</a></td>
                                            <td class="p-1 m-0">{{ $practica->tipopractica }}</td>
                                            <td class="p-1 m-0">{{ $practica->fechainiciopractica }}</td>
                                            <td class="p-1 m-0">{{ $practica->fechafinpractica }}</td>
                                            <td>
                                                <a  class="btn btn-link" href="{{ URL::to('practicas/' . $practica->idpractica . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>

@stop