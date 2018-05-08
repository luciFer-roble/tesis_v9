@extends('layouts.master')
@section('content')

    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Empresas</a></li>
                <li class="breadcrumb-item active">Nueva</li>
            </ol>
            </nav>
            <div class="row">
            <form method="POST" action="../tutores">

                {{ csrf_field() }}

                <div class="formgroup" width="100">
                    <label for="empresa">Empresa:</label>
                    <select id="empresa" name="empresa" class="form-control">
                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->idempresa }}">{{ $empresa->nombreempresa }}</option>
                        @endforeach
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
    </div>
@stop