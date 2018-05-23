@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Empresa</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Empresas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">





            {{Form::open( ['method'=>"PUT", 'url'=>array("/empresas", $empresa->idempresa)]) }}

                {{ csrf_field() }}
                <div class="formgroup" width="100">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empresa->nombreempresa }}">
                </div>

                <div class="formgroup">
                    <label for="direccion">Direccion:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $empresa->direccionempresa }}">
                </div>

                <div class="formgroup">
                    <label for="sector">Sector:</label>
                    <input type="text" class="form-control" id="sector" name="sector" value="{{ $empresa->sectorempresa }}">
                </div>

                <div class="formgroup">
                    <label for="telefono">Telefono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $empresa->telefonoempresa }}">
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </orm>

            @include('layouts.errors')

        </div>
    </div>
@stop