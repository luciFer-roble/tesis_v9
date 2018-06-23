@extends('layouts.master')

@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <input type="button" onClick="location.href = 'estudiantes/create'" class="btn btn-sm btn-outline-secondary" value="NUEVO"></input>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h1>ESTUDIANTES</h1></div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Cedula</th>
                                        <th>Primer Nombre</th>
                                        <th>Segundo Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Tipo</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Genero</th>
                                        <th>Facultad</th>
                                        <th>Escuela</th>
                                        <th>Carrera</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($estudiantes as $estudiante)
                                        <tr>
                                            <td>{{ $estudiante->cedulaestudiante }}</td>
                                            <td>{{ $estudiante->nombre1estudiante }}</td>
                                            <td>{{ $estudiante->nombre2estudiante }}</td>
                                            <td>{{ $estudiante->apellido1estudiante }}</td>
                                            <td>{{ $estudiante->apellido2estudiante }}</td>
                                            <td>{{ $estudiante->tipoestudiante }}</td>
                                            <td>{{ $estudiante->celularestudiante }}</td>
                                            <td>{{ $estudiante->correoestudiante }}</td>
                                            <td>{{ $estudiante->fechanacimientoestudiante }}</td>
                                            <td>{{ $estudiante->generoestudiante }}</td>
                                            <td>{{ $estudiante->carrera->escuela->facultad->nombrefacultad }}</td>
                                            <td>{{ $estudiante->carrera->escuela->nombreescuela }}</td>
                                            <td>{{ $estudiante->carrera->nombrecarrera }}</td>
                                            <td>




                                                    <div class="col-sm1">
                                                        {{ Form::open(array('url' => 'estudiantes/' . $estudiante->idestudiante, 'class' => '')) }}

                                                        <a  class="btn btn-link" href="{{ URL::to('estudiantes/' . $estudiante->idestudiante . '/edit') }}">

                                                            <i class="fa fa-fw fa-pencil-alt"></i>

                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        <button type="submit" class="btn btn-link"><i class="fa fa-fw fa-trash-alt" style="color: #f10407"></i></button>
                                                        {{ Form::close() }}
                                                    </div>


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
    </div>

@stop