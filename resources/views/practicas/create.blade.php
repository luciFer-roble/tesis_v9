@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nueva Practica</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/practicas">Practicas</a></li>
    <li class="breadcrumb-item active">Nueva</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                <form method="POST" action="/practicas">

                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">

                            <label class="col-sm-10 control-label" for="estudiante">Estudiante:</label>
                            <div class="col-lg-11">
                                <select id="estudiante" name="estudiante" class="form-control">
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->idestudiante }}"
                                        >{{ ($estudiante->nombre1estudiante).' '.($estudiante->nombre2estudiante).' '.($estudiante->apellido1estudiante).' '.($estudiante->apellido2estudiante) }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="empresa">Empresa:</label>
                            <div class="col-lg-11">
                                <select id="empresa" name="empresa" class="form-control">
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->idempresa }}"
                                        >{{ $empresa->nombreempresa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{--<div class="col-lg-6" width="100%">

                        </div>
                        <div class="col-lg-1" ><span class="float-right" width="100%">
                                <a href="/actividades/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">SEGUIMIENTO</a>
                            </span>
                        </div>
                        <div class="col-lg-1" width="100%">
                        </div>--}}
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="tutore">Tutor Empresarial:</label>

                            <div class="col-lg-11">
                                <div class="input-group mb-3">
                                    <select id="tutore" name="tutore" class="form-control">
                                        @foreach($tutores as $tutore)
                                            <option value="{{ $tutore->idtutore }}"
                                            >{{ $tutore->nombretutore .' '. $tutore->apellidotutore }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                            <span class="input-group-text">
                                            <a href="{{ URL::to('tutores/' . $empresa->idempresa . '/createfrom') }}">
                                                <i class="fa fa-fw fa-plus"></i>
                                            </a>
                                                </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{--<div class="col-lg-6" width="100%">
                        </div>
                        <div class="col-lg-1" width="100"><span class="float-right" width="100%">
                                <a href="/documentos/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">DOCUMENTOS</a></span>
                        </div>
                        <div class="col-lg-1" width="100%">
                        </div>--}}

                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="profesor">Tutor Academico:</label>
                            <div class="col-lg-11">
                                <select id="profesor" name="profesor" class="form-control">
                                    @foreach($profesores as $profesor)
                                        <option value="{{ $profesor->idprofesor }}"
                                        >{{ $profesor->nombre1profesor .' '. $profesor->apellido1profesor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="tipo">Tipo:</label>
                            <div class="col-lg-11">
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="Practica"
                                    >Practica Pre-Profesional</option>
                                    <option value="Pasantia"
                                    >Pasantia</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="salario">Sueldo/salario:</label>
                            <div class="col-lg-11">
                                <input type="text" class="form-control" id="salario" name="salario" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Fecha de Inicio:</label>
                            <div class="col-lg-11">
                                <input type="date" class="form-control" id="inicio" name="inicio">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="descripcion">Descripcion:</label>
                            <div class="col-lg-11">
                                <textarea  class="form-control" id="descripcion" name="descripcion" ></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>

                    </div>
                </form>

                </div>
                </form>
                @include('layouts.errors')
            </div>
            </div>

        </div>
    </div>
@stop