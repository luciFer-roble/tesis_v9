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
    <div id="app" >
        <div class="col-lg-12">

            <div class="">
                <form method="POST" action="/estasignaturas">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-3" width="100">
                            <label for="asignatura1">Asignatura 1:</label>
                        </div>

                        <div class="col-lg-3" width="100">

                            <listarasignatura codigo="{{ $idcarrera }}">

                            </listarasignatura>
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
    <script>

    </script>
@stop