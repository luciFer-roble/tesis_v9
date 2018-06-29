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
                                        <td colspan="3"></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($estudiantes as $estudiante)
                                        <tr>
                                            <td class="p-1 m-0">{{ $estudiante->cedulaestudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->nombre1estudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->nombre2estudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->apellido1estudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->apellido2estudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->tipoestudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->celularestudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->correoestudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->fechanacimientoestudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->generoestudiante }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->carrera->escuela->facultad->nombrefacultad }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->carrera->escuela->nombreescuela }}</td>
                                            <td class="p-1 m-0">{{ $estudiante->carrera->nombrecarrera }}</td>
                                            <td>
                                                <a  class="btn btn-link" href="{{ URL::to('estudiantes/' . $estudiante->idestudiante . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i></a>
                                            </td>
                                            <td>{{ Form::open(array('url' => 'estudiantes/' . $estudiante->idestudiante, 'class' => '')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <button type="submit" class="btn btn-link"><i class="fa fa-fw fa-trash-alt" style="color: #f10407"></i></button>
                                                {{ Form::close() }}</td>
                                            <td>
                                                <a  class="btn btn-link" href="{{ URL::to('estasignaturas/' . $estudiante->carrera->idcarrera . '/create/' . $estudiante->idestudiante) }}">

                                                    <i class="fa fa-fw fa-clipboard-list"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <form method="POST" action="/estudiantes">

                                        {{ csrf_field() }}
                                        <tr>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="cedula" name="cedula"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="nombre1" name="nombre1"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="nombre2" name="nombre2"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="apellido1" name="apellido1"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="apellido2" name="apellido2"></td>
                                            <td class="p-0 m-0"><select id="tipo" name="tipo" class="form-control">
                                                    <option value="regular">Regular</option>
                                                    <option value="semi">Semi-Presencial</option>
                                                    <option value="distancia">Distancia</option>
                                                </select></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="celular" name="celular"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="correo" name="correo"></td>
                                            <td class="p-0 m-0"><input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento"></td>
                                            <td class="p-0 m-0"><select id="genero" name="genero" class="form-control">
                                                    <option value="0">Masculino</option>
                                                    <option value="1">Femenino</option>
                                                </select></td>
                                            <td class="p-0 m-0"><select id="facultad" name="facultad" class="form-control">
                                                    @foreach($facultades as $facultad)
                                                        <option value="{{ $facultad->idfacultad }}">{{ $facultad->nombrefacultad }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td class="p-0 m-0"><select id="escuela" name="escuela" class="form-control">
                                                    @foreach($escuelas as $escuela)
                                                        <option value="{{ $escuela->idescuela }}">{{ $escuela->nombreescuela }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td class="p-0 m-0"><select id="carrera" name="carrera" class="form-control">
                                                    @foreach($carreras as $carrera)
                                                        <option value="{{ (string)$carrera->idcarrera }}">{{ $carrera->nombrecarrera }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td class="p-0 m-0" colspan="3"><button type="submit" class="btn btn-primary btn-block">Insertar</button></td>
                                        </tr>
                                    </form>
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