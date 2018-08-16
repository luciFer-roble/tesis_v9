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
                    <div class="card">
                    <div class="col-lg-12 card-body">

                            <listarasignatura codigo="{{ $idcarrera }} " estudiante="{{ $estudiante->idestudiante }}" :asignaturas="{{ $asignaturas }}">

                            </listarasignatura>
                    </div>
                    <hr>

                    <div class="col-lg-12 -align-right m-lg-4">
                        <a href="#" onclick="history.go(-1)" class="btn btn-primary float-left">OK</a>
                    </div>
                    </div>
            </div>


        </div>
    </div>
    <script>

    </script>
@stop