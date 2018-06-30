@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Estudiante</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Estudiantes</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="" >

        <div class="col-lg-12">

            <div class="">
                {{Form::open( ['method'=>"PUT", 'url'=>array("/estudiantes", $estudiante->idestudiante)]) }}

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6" width="200">
                            <label for="cedula">Cedula:</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $estudiante->cedulaestudiante }}">
                        </div>

                        <div class="col-lg-6" width="100">
                            <label for="sede">Sede:</label>
                            <select id="sede" name="sede" class="form-control">
                                @foreach($sedes as $sede)
                                    <option value="{{ $sede->idsede }}"
                                            @if($sede->idsede == $estudiante->carrera->escuela->facultad->sede->idsede)
                                            selected
                                            @endif
                                    >{{ $sede->nombresede }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="nombre1">Primer Nombre:</label>
                            <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ $estudiante->nombre1estudiante }}">
                        </div>

                        <div class="col-lg-6" width="100">
                            <label for="facultad">Facultad:</label>
                            <select id="facultad" name="facultad" class="form-control">
                                @foreach($facultades as $facultad)
                                    <option value="{{ $facultad->idfacultad }}"
                                            @if($facultad->idfacultad == $estudiante->carrera->escuela->facultad->idfacultad)
                                            selected
                                            @endif
                                    >{{ $facultad->nombrefacultad }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="nombre2">Segundo Nombre:</label>
                            <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ $estudiante->nombre2estudiante }}">
                        </div>

                        <div class="col-lg-6" width="100">
                            <label for="escuela">Escuela:</label>
                            <select id="escuela" name="escuela" class="form-control">
                                @foreach($escuelas as $escuela)
                                    <option value="{{ $escuela->idescuela }}"
                                            @if($escuela->idescuela == $estudiante->carrera->escuela->idescuela)
                                            selected
                                            @endif
                                    >{{ $escuela->nombreescuela }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="apellido1">Primer Apellido:</label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ $estudiante->apellido1estudiante }}">
                        </div>

                        <div class="col-lg-6" width="100">
                            <label for="carrera">Carrera:</label>
                            <select id="carrera" name="carrera" class="form-control">
                                @foreach($carreras as $carrera)
                                    <option value="{{ (string)$carrera->idcarrera }}"
                                            @if($carrera->idcarrera == $estudiante->carrera->idcarrera)
                                            selected
                                            @endif
                                    >{{ $carrera->nombrecarrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="apellido2">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ $estudiante->apellido2estudiante }}">
                        </div>

                        <div class="col-lg-6" width="100">
                            <label for="fechanacimiento">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" value="{{ $estudiante->fechanacimientoestudiante }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="genero">Genero:</label>
                            <select id="genero" name="genero" class="form-control">
                                <option value="0"
                                        @if('0' == $estudiante->generoestudiante)
                                        selected
                                        @endif
                                >Masculino</option>
                                <option value="1"
                                        @if('1' == $estudiante->generoestudiante)
                                        selected
                                        @endif
                                >Femenino</option>
                            </select>
                        </div>

                        <div class="col-lg-6" width="100">
                            <label for="tipo">Modalidad:</label>
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="Regular"
                                        @if('Regular' == $estudiante->tipoestudiante)
                                        selected
                                        @endif
                                >Regular</option>
                                <option value="Semipresencial"
                                        @if('Semipresencial' == $estudiante->tipoestudiante)
                                        selected
                                        @endif
                                >Semi-Presencial</option>
                                <option value="Distancia"
                                        @if('Distancia' == $estudiante->tipoestudiante)
                                        selected
                                        @endif
                                >Distancia</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" width="100">
                            <label for="celular">Numero de celular:</label>
                            <input type="text" class="form-control" id="celular" name="celular" value="{{ $estudiante->celularestudiante }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" width="100">
                            <label for="correo">Correo electronico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $estudiante->correoestudiante }}">
                        </div>
                    </div>


                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                @include('layouts.errors')
            </div>


        </div>
    </div>
@stop