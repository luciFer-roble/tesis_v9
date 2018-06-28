@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Facultades</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Facultades</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">





            {{Form::open( ['method'=>"PUT", 'url'=>array("/facultades", $facultad->idfacultad)]) }}

                {{ csrf_field() }}
                <div class="formgroup" width="100">
                    <label for="id">Id:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $facultad->idfacultad }}">
                </div>
                <div class="formgroup" width="100">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $facultad->nombrefacultad }}">
                </div>

                <div class="formgroup">
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $facultad->descripcionfacultad }}">
                </div>
                <div class="formgroup" width="100">
                    <label for="mision">Mision:</label>
                    <input type="text" class="form-control" id="mision" name="mision" value="{{ $facultad->misionfacultad }}">
                </div>

                <div class="formgroup">
                    <label for="vision">Vision:</label>
                    <input type="text" class="form-control" id="vision" name="vision" value="{{ $facultad->visionfacultad }}">
                </div>
                <div class="formgroup" width="100">
                    <label for="sede">Sede:</label>
                    <select id="sede" name="sede" class="form-control">
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->idsede }}"
                                    @if($sede->idsede == $facultad->idsede)
                                    selected
                                    @endif
                            >{{ $sede->nombresede }}</option>
                        @endforeach
                    </select>
                </div>

                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a  class="btn btn-primary" href="{{ URL::to('escuelas/' . $facultad->idfacultad . '/create') }}">
                        Anadir Escuelas
                    </a>
                    <a  class="btn btn-primary" href="{{ URL::to('escuelas/' . $facultad->idfacultad . '/list') }}">
                        Escuelas
                    </a>
                </div>
            </form>

            @include('layouts.errors')

        </div>
    </div>
@stop