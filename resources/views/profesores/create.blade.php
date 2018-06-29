@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Profesor</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/profesores">Profesores</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')

    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">
                <form method="POST" action="/profesores">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="id">Id:</label>
                            <input type="text" class="form-control" id="id" name="id">
                        </div>

                        <div class="col-lg-6" width="100">
                            <label for="escuela">Escuela:</label>
                            <select id="escuela" name="escuela" class="form-control">
                                @foreach($escuelas as $escuela)
                                    <option value="{{ $escuela->idescuela }}">{{ $escuela->nombreescuela }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="nombre1">Primer Nombre:</label>
                            <input type="text" class="form-control" id="nombre1" name="nombre1">
                        </div>
                        <div class="col-lg-6" width="100">
                            <label for="nombre2">Segundo Nombre:</label>
                            <input type="text" class="form-control" id="nombre2" name="nombre2">
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-lg-6" width="100">
                            <label for="apellido1">Primer Apellido:</label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1">
                        </div>
                        <div class="col-lg-6" width="100">
                            <label for="apellido2">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2">
                        </div>

                    </div>



                    <div class="row" style="width: 51%" >
                        <div class="col-lg-12">
                            <label for="oficina">Oficina:</label>
                            <input type="text" class="form-control" id="oficina" name="oficina" width="50%">
                        </div>
                    </div>
                    <div class="row" style="width: 51%" >
                        <div class="col-lg-12" width="50%">
                            <label for="celular">Numero de celular:</label>
                            <input type="text" class="form-control" id="celular" name="celular">
                        </div>
                    </div>

                    <div class="row" style="width: 51%" >
                        <div class="col-lg-12" width="50%">
                            <label for="correo">Correo electronico:</label>
                            <input type="email" class="form-control" id="correo" name="correo">
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
@stop