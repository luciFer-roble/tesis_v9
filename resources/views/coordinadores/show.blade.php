@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Coordinador</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item active">Coordinador</li>
@endsection

@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h1>COORDINADOR</h1></div>
                        <div class="card-body">

                            <div class="row">
                                <div class="jumbotron text-center">
                                    <h2>{{ $coordinador->profesor->nombre1profesor }}</h2>
                                    <p>
                                        <strong>Carrera:</strong> {{ $coordinador->carrera->nombrecarrera }}<br>
                                        <strong>Correo:</strong> {{ $coordinador->profesor->correoprofesor }}<br>
                                        <strong>Celular:</strong> {{ $coordinador->profesor->celularprofesor }}<br>
                                        <strong>Oficina:</strong> {{ $coordinador->profesor->oficinaprofesor }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop