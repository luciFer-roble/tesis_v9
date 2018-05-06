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
            <form method="POST" action="/tesisv1/public/empresas">

                {{ csrf_field() }}
                <div class="formgroup" width="100">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>

                <div class="formgroup">
                    <label for="direccion">Direccion:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>

                <div class="formgroup">
                    <label for="sector">Sector:</label>
                    <input type="text" class="form-control" id="sector" name="sector">
                </div>

                <div class="formgroup">
                    <label for="telefono">Telefono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
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