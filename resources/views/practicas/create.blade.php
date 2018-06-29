@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Estudiante</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Estudiantes</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')
    <div class="" >

        <div class="col-lg-12">

            <div class="">
                <form method="POST" action="/practicas">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="estudiante">Estudiante:</label>
                            <select id="estudiante" name="estudiante" class="form-control">
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->idestudiante }}">{{ ($estudiante->nombre1estudiante).' '.($estudiante->nombre2estudiante).' '.($estudiante->apellido1estudiante).' '.($estudiante->apellido2estudiante) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="empresa">Empresa:</label>
                            <select id="empresa" name="empresa" class="form-control">
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->idempresa }}">{{ $empresa->nombreempresa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6" width="100%">
                        </div>
                        <div class="col-lg-1" ><span class="float-right">
                            <button width='100%' class="btn btn-primary">ACTIVIDADES</button></span>
                        </div>
                        <div class="col-lg-1" width="100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <div class="row">
                            <label for="tutore">Tutor Empresarial:</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-11">
                                <select id="tutore" name="tutore" class="form-control">
                                @foreach($tutores as $tutore)
                                    <option value="{{ $tutore->idtutore }}">{{ $tutore->nombretutore .' '. $tutore->apellidotutore }}</option>
                                @endforeach
                                </select>
                                </div>
                                <div class="col-lg-1" >
                                    <span class="float-left"><a  class="btn btn-link" href="{{ URL::to('tutores/' . $empresa->idempresa . '/createfrom') }}">
                                        <i class="fa fa-fw fa-plus"></i>
                                    </a></span>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6" width="100%">
                        </div>
                        <div class="col-lg-1" width="100"><span class="float-right">
                            <button  width='100%' class="btn btn-primary">DOCUMENTOS</button></span>
                        </div>
                        <div class="col-lg-1" width="100%">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="profesor">Tutor Academico:</label>
                            <select id="profesor" name="profesor" class="form-control">
                                @foreach($profesores as $profesor)
                                    <option value="{{ $profesor->idprofesor }}">{{ $profesor->nombre1profesor .' '. $profesor->apellido1profesor }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="tipo">Tipo:</label>
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="Practica">Practica Pre-Profesional</option>
                                <option value="Pasantia">Pasantia</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="salario">Sueldo/salario:</label>
                            <input type="text" class="form-control" id="salario" name="salario">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="inicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="inicio" name="inicio">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="descripcion">Descripcion:</label>
                            <textarea  class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                    </div>


                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
                @include('layouts.errors')
            </div>


        </div>
    </div>
@stop