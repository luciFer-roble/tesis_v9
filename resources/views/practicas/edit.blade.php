@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Detalles de la practica</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/practicas">Practicas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form role="form">
                {{Form::open( ['method'=>"PUT", 'url'=>array("/practicas", $practica->idpractica)]) }}

                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">

                            <label class="col-sm-10 control-label" for="estudiante">Estudiante:</label>
                            <div class="col-lg-11">
                            <select id="estudiante" name="estudiante" class="form-control">
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->idestudiante }}"
                                            @if($estudiante->idestudiante == $practica->idestudiante)
                                            selected
                                            @endif
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
                                            @if($empresa->idempresa == $practica->tutore->empresa->idempresa)
                                            selected
                                            @endif
                                    >{{ $empresa->nombreempresa }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="tutore">Tutor Empresarial:</label>

                                <div class="col-lg-11">
                                    <div class="input-group mb-3">
                                        <select id="tutore" name="tutore" class="form-control">
                                            @foreach($tutores as $tutore)
                                                <option value="{{ $tutore->idtutore }}"
                                                        @if($tutore->idtutore == $practica->idtutore)
                                                        selected
                                                        @endif
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
                                            @if($profesor->idprofesor == $practica->idprofesor)
                                            selected
                                            @endif
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
                                        @if("Practica" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Practica Pre-Profesional</option>
                                <option value="Pasantia"
                                        @if("Pasantia" == $practica->tipopractica)
                                        selected
                                        @endif
                                >Pasantia</option>
                            </select>
                            </div>
                        </div>
                                <div class="form-group">
                                    <label class="col-sm-10 control-label" for="salario">Sueldo/salario:</label>
                                    <div class="col-lg-11">
                                    <input type="text" class="form-control" id="salario" name="salario" value="{{ $practica->salariopractica }}">

                                    </div>
                                </div>

                    <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Fecha de Inicio:</label>
                        <div class="col-lg-11">
                            <input type="date" class="form-control" id="inicio" name="inicio" value="{{ $practica->fechainiciopractica }}">
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="periodo">Periodo Academico:</label>
                            <div class="col-lg-11">
                                <select id="periodo" name="periodo" class="form-control">
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->idperiodoacademico }}"
                                                @if($periodo->idperiodoacademico == $practica->idperiodoacademico)
                                                selected
                                                @endif
                                        >{{ $periodo->nombreperiodoacademico }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="horas">Horas:</label>
                            <div class="col-lg-11">
                                <input type="text" class="form-control" id="horas" name="horas" value="{{ $practica->horaspractica }}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="descripcion">Descripcion:</label>
                            <div class="col-lg-11">
                            <textarea  class="form-control" id="descripcion" name="descripcion" >{{ $practica->descripcionpractica }}</textarea>
                        </div>
                        </div>

                    </div>
                    <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>

                            <button type="submit" class="btn btn-danger float-right">FINALIZAR</button>

                        </div>
                    </form>

                    </div>
                    </form>
                @include('layouts.errors')

                </div>

            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Opciones</h3>
                    </div>
                    <div class="form-horizontal">

                        <div class="card-body">
                            <div class="form-group">
                            <div class="col-5" >
                                <span >
                                     <a href="/actividades/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">SEGUIMIENTO</a>
                                </span>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-5">
                                <span >
                                <a href="/documentos/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">DOCUMENTOS</a></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-5">
                                <span >
                                 <a href="#"  class="btn btn-danger btn-lg btn-block">FINALIZAR</a></span></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
            </div>

        </div>
    </div>
@stop