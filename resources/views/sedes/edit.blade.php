@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Editar Sedes</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/sedes">Sedes</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">


            {{Form::open( ['method'=>"PUT", 'url'=>array("/sedes", $sede->idsede)]) }}

                {{ csrf_field() }}
                <div class="formgroup" width="100">
                    <label for="id">Id:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $sede->idsede }}">
                </div>
                <div class="formgroup" width="100">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $sede->nombresede }}">
                </div>

                <div class="formgroup">
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $sede->descripcionsede }}">
                </div>
                
                <div class="formgroup" width="100">
                    <label for="universidad">Universidad:</label>
                    <select id="universidad" name="universidad" class="form-control">
                        @foreach($universidades as $uni)
                            <option value="{{ $uni->iduniversidad }}"
                                    @if($uni->iduniversidad == $sede->iduniversidad)
                                    selected
                                    @endif
                            >{{ $uni->nombreuniversidad }}</option>
                        @endforeach
                    </select>
                </div>

                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a  class="btn btn-primary" href="{{ URL::to('facultades/' . $sede->idsede . '/create') }}">
                        Anadir Facultades
                    </a>
                    <a  class="btn btn-primary" href="{{ URL::to('facultades/' . $sede->idsede . '/list') }}">
                        Facultades
                    </a>
                </div>
            </form>

            @include('layouts.errors')

        </div>
    </div>
@stop