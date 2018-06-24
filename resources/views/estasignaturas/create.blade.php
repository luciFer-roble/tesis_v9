@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Registrar Asignaturas</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">{{ $estudiante->nombre1estudiante .' '.$estudiante->apellido1estudiante }}</a></li>
    <li class="breadcrumb-item active">Asignaturas</li>
@endsection
@section('content')
    <div class="" >

        <div class="col-lg-12">

            <div class="">
                <form method="POST" action="/estasignaturas">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-3" width="100">
                            <label for="asignatura1">Asignatura 1:</label>
                        </div>

                        <div class="col-lg-3" width="100">
                            <select id="asignatura1" name="asignatura1" class="form-control">
                                <option>--Seleccione--</option>
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->idasignatura }}">{{ $asignatura->nombreasignatura }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3" width="100">
                            <label for="asignatura2">Asignatura 2:</label>
                        </div>

                        <div class="col-lg-3" width="100">
                            <select id="asignatura2" name="asignatura2" class="form-control">
                                <option>--Seleccione--</option>
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->idasignatura }}">{{ $asignatura->nombreasignatura }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3" width="100">
                            <label for="asignatura3">Asignatura 3:</label>
                        </div>

                        <div class="col-lg-3" width="100">
                            <select id="asignatura3" name="asignatura3" class="form-control">
                                <option>--Seleccione--</option>
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->idasignatura }}">{{ $asignatura->nombreasignatura }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3" width="100">
                            <label for="asignatura4">Asignatura 4:</label>
                        </div>

                        <div class="col-lg-3" width="100">
                            <select id="asignatura4" name="asignatura4" class="form-control">
                                <option>--Seleccione--</option>
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->idasignatura }}">{{ $asignatura->nombreasignatura }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3" width="100">
                            <label for="asignatura5">Asignatura 5:</label>
                        </div>

                        <div class="col-lg-3" width="100">
                            <select id="asignatura5" name="asignatura5" class="form-control">
                                <option>--Seleccione--</option>
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->idasignatura }}">{{ $asignatura->nombreasignatura }}</option>
                                @endforeach
                            </select>
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