@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Profesor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/profesores">Profesores</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">

            {{Form::open( ['method'=>"PUT", 'url'=>array("/profesores", $profesor->idprofesor)]) }}

            {{ csrf_field() }}
            <div class="formgroup" width="100">
                <label for="id">Id:</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ $profesor->idprofesor }}">
            </div>
            <div class="formgroup" width="100">
                <label for="escuela">Escuela:</label>
                <select id="escuela" name="escuela" class="form-control">
                    @foreach($escuelas as $escuela)
                        <option value="{{ $escuela->idescuela }}"
                                @if($escuela->idescuela == $profesor->idescuela)
                                selected
                                @endif
                        >{{ $escuela->nombreescuela }}</option>
                    @endforeach
                </select>
            </div>
            <div class="formgroup" width="100">
                <label for="nombre1">Primer Nombre:</label>
                <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ $profesor->nombre1profesor }}">
            </div>
            <div class="formgroup" width="100">
                <label for="nombre2">Segundo Nombre:</label>
                <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ $profesor->nombre2profesor }}">
            </div>

            <div class="formgroup" width="100">
                <label for="apellido1">Apellido Paterno:</label>
                <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ $profesor->apellido1profesor }}">
            </div>
            <div class="formgroup" width="100">
                <label for="apellido2">Apellido Materno:</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ $profesor->apellido2profesor }}">
            </div>

            <div class="formgroup">
                <label for="correo">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" value="{{ $profesor->correoprofesor }}">
            </div>
            <div class="formgroup">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" value="{{ $profesor->celularprofesor }}">
            </div>
            <div class="formgroup">
                <label for="oficina">Oficina:</label>
                <input type="text" class="form-control" id="oficina" name="oficina" value="{{ $profesor->oficinaprofesor }}">
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