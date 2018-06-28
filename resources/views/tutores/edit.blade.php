@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Tutor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/tutores">Tutores</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">
            <div class="row">
            {{Form::open( ['method'=>"PUT", 'url'=>array("/tutores", $tutore->idtutore)]) }}

            {{ csrf_field() }}


            <div class="formgroup" width="100">
                <label for="empresa">Empresa:</label>
                <select id="empresa" name="empresa" class="form-control">
                    @foreach($empresas as $empresa)
                        <option value="{{ $empresa->idempresa }}"
                                @if($empresa->idempresa == $tutore->idempresa)
                                    selected
                                @endif
                        >{{ $empresa->nombreempresa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="formgroup" width="100">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tutore->nombretutore }}">
            </div>

            <div class="formgroup">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $tutore->apellidotutore }}">
            </div>

            <div class="formgroup">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" value="{{ $tutore->celulartutore }}">
            </div>

            <div class="formgroup">
                <label for="correo">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" value="{{ $tutore->correotutore }}">
            </div>
            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            </form>
            </div>

            @include('layouts.errors')

        </div>
    </div>
@stop