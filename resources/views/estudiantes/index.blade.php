@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Estudiantes</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">
                    <!-- Example DataTables Card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">

                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <h1>ESTUDIANTES</h1></div>
                                    <div class="btn-group mr-2">
                                        <input  type="button" onClick="location.href = 'estudiantes/create'" class="btn btn-sm btn-outline-secondary" value="NUEVO"></input>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">

                                <table class="table table-bordered"  >
                                <thead>
                                <tr>
                                    <th style="vertical-align: middle" >Cedula</th>
                                    <th style="vertical-align: middle">Primer Nombre</th>
                                    <th style="vertical-align: middle">Segundo Nombre</th>
                                    <th style="vertical-align: middle">Apellido Paterno</th>
                                    <th style="vertical-align: middle">Apellido Materno</th>
                                    <th style="vertical-align: middle">Tipo</th>
                                    <th style="vertical-align: middle">Celular</th>
                                    <th style="vertical-align: middle">Correo</th>
                                    <th style="vertical-align: middle">Fec de Nacimiento</th>
                                    <th style="vertical-align: middle">Genero</th>
                                    <th style="vertical-align: middle">Facultad</th>
                                    <th style="vertical-align: middle">Escuela</th>
                                    <th style="vertical-align: middle">Carrera</th>
                                    <td style="vertical-align: middle"></td>

                                </tr>
                                </thead>

                                    <tbody >
                                    @foreach($estudiantes as $estudiante)
                                        <tr>
                                            <td style="vertical-align: middle" >{{ $estudiante->cedulaestudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->nombre1estudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->nombre2estudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->apellido1estudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->apellido2estudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->tipoestudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->celularestudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->correoestudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->fechanacimientoestudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->generoestudiante }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->carrera->escuela->facultad->nombrefacultad }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->carrera->escuela->nombreescuela }}</td>
                                            <td style="vertical-align: middle">{{ $estudiante->carrera->nombrecarrera }}</td>
                                            <td>

                                                    <a  class="btn btn-link" href="{{ URL::to('estudiantes/' . $estudiante->idestudiante . '/edit') }}">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a>
                                                    {{ Form::open(array('url' => 'estudiantes/' . $estudiante->idestudiante, 'class' => '')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    <button type="submit" class="btn btn-link"><i class="fa fa-fw fa-trash-alt" style="color: #f10407"></i></button>
                                                    {{ Form::close() }}

                                                    <a  class="btn btn-link" href="{{ URL::to('estasignaturas/' . $estudiante->carrera->idcarrera . '/create/' . $estudiante->idestudiante) }}">

                                                        <i class="fa fa-fw fa-clipboard-list"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                        <form method="POST" action="/estudiantes">
                                            {{ csrf_field() }}

                                            <tr >
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
                                                <td style="vertical-align: middle" class="p-0 m-0"><button type="submit"class="btn btn-sm btn-primary">Insertar</button></td>
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

@stop