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

            <div class="row">
                <form method="POST" action="/estasignaturas">

                    {{ csrf_field() }}
                    <div class="col-lg-12">

                            <listarasignatura codigo="{{ $idcarrera }} " estudiante="{{ $estudiante->idestudiante }}">

                            </listarasignatura>
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