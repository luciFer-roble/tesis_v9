@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Carreras</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Carreras</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">





            {{Form::open( ['method'=>"PUT", 'url'=>array("/carreras", $carrera->idcarrera)]) }}

                {{ csrf_field() }}
                <div class="formgroup" width="100">
                    <label for="id">Id:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $carrera->idcarrera }}">
                </div>
                <div class="formgroup" width="100">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $carrera->nombrecarrera }}">
                </div>

                <div class="formgroup">
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $carrera->descripcioncarrera }}">
                </div>
                <div class="formgroup" width="100">
                    <label for="escuela">Escuela:</label>
                    <select id="escuela" name="escuela" class="form-control">
                        @foreach($escuelas as $escuela)
                            <option value="{{ $escuela->idescuela }}"
                                    @if($escuela->idescuela == $carrera->idescuela)
                                    selected
                                    @endif
                            >{{ $escuela->nombreescuela }}</option>
                        @endforeach
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
@stop