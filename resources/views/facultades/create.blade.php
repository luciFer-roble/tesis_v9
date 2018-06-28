@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nueva Facultad</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="#">Inicio</a></li>
<li class="breadcrumb-item"><a href="#">Facultades</a></li>
<li class="breadcrumb-item active">Nueva</li>
    @endsection
@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">

            <div class="row">
            <form method="POST" action="/facultades">

                {{ csrf_field() }}
                <div class="formgroup" width="100">
                    <label for="id">Id:</label>
                    <input type="text" class="form-control" id="id" name="id">
                </div>
                <div class="formgroup" width="100">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>

                <div class="formgroup">
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion">
                </div>
                <div class="formgroup">
                    <label for="mision">Mision:</label>
                    <input type="text" class="form-control" id="mision" name="mision">
                </div>

                <div class="formgroup">
                    <label for="vision">Vision:</label>
                    <input type="text" class="form-control" id="vision" name="vision">
                </div>
                <div class="col-lg-6" width="100">
                    <label for="sede">Sede:</label>
                        <select id="sede" name="sede" class="form-control">
                            @if (empty($sede))
                                @foreach($sedes as $sede)
                                    <option value="{{ (string)$sede->idsede }}">{{ $sede->nombresede }}</option>
                                @endforeach
                            @else
                                @foreach($sedes as $sed)
                                    <option value="{{ $sed->idsede }}"
                                                @if($sed->idsede == $sede->idsede)
                                                    selected
                                                @endif
                                    >{{ $sed->nombresede }}</option>
                                @endforeach
                            @endif
                        </select>
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