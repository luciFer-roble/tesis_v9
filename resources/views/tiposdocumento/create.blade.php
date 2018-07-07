@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Tipo de Documento</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/tiposdocumento">Tipos de Documentos</a></li>
<li class="breadcrumb-item active">Nuevo</li>
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
            <form method="POST" action="/tiposdocumento">

                {{ csrf_field() }}
                <div class="card-body">
                    <div class="formgroup" class="col-lg-6">
                        <label for="id">Id:</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>

                    <div class="formgroup">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                    </div>

                </div>

                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>

            </form>
                @include('layouts.errors')
            </div>

            </div>
        </div>
    </div>
@stop