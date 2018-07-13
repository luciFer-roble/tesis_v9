@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Detalles de la practica</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Practicas</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')
    <div class="" >

        <div class="col-lg-12">

            <div class="">
                {{Form::open( ['method'=>"PUT", 'url'=>array("/practicas", $practica->idpractica)]) }}

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="estudiante">Estudiante:</label>
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
                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="empresa">Empresa:</label>
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

                        <div class="col-lg-6" width="100%">
                        </div>
                        <div class="col-lg-1" ><span class="float-right" width="100%">
                                <a href="/actividades/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">SEGUIMIENTO</a>
                            </span>
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
                                            <option value="{{ $tutore->idtutore }}"
                                                    @if($tutore->idtutore == $practica->idtutore)
                                                    selected
                                                    @endif
                                            >{{ $tutore->nombretutore .' '. $tutore->apellidotutore }}</option>
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
                        <div class="col-lg-1" width="100"><span class="float-right" width="100%">
                                <a href="/documentos/{{ $practica->idpractica .'/list'}}"  class="btn btn-info btn-lg btn-block">DOCUMENTOS</a></span>
                        </div>
                        <div class="col-lg-1" width="100%">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="profesor">Tutor Academico:</label>
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


                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="tipo">Tipo:</label>
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

                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="salario">Sueldo/salario:</label>
                            <input type="text" class="form-control" id="salario" name="salario" value="{{ $practica->salariopractica }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4" width="100">
                            <label for="inicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="inicio" name="inicio" value="{{ $practica->fechainiciopractica }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="descripcion">Descripcion:</label>
                            <textarea  class="form-control" id="descripcion" name="descripcion" >{{ $practica->descripcionpractica }}</textarea>
                        </div>
                    </div>


                    <hr>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        <div class="col-sm-8"></div>
                        <div class="col-sm-2">
                            <span class="float-right">
                            <button type="submit" class="btn btn-danger btn-lg">FINALIZAR</button>
                            </span>
                        </div>
                    </div>

                </form>
                @include('layouts.errors')
            </div>


        </div>
    </div>
@stop