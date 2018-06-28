@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Tutor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/tutores">Tutores</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')

    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">

            <form method="POST" action="/tutores">

                {{ csrf_field() }}

                <div class="form-group" width="100">
                    <label for="empresa">Empresa:</label>
                    <select id="empresa" name="empresa" class="form-control">
                        @if (empty($empresa))
                            @foreach($empresas as $empresa)
                                <option value="{{ (string)$empresa->idempresa }}">{{ $empresa->nombreempresa }}</option>
                            @endforeach
                        @else
                            @foreach($empresas as $emp)
                                <option value="{{ $emp->idempresa }}"
                                        @if($emp->idempresa == $empresa->idempresa)
                                        selected
                                        @endif
                                >{{ $emp->nombreempresa }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="formgroup" width="100">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>

                <div class="formgroup">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido">
                </div>

                <div class="formgroup">
                    <label for="celular">Celular:</label>
                    <input type="text" class="form-control" id="celular" name="celular">
                </div>

                <div class="formgroup">
                    <label for="correo">Correo:</label>
                    <input type="text" class="form-control" id="correo" name="correo">
                </div>
                <hr>
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
                @include('layouts.errors')


        </div>
    </div>
@stop