@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Cambiar Coordinador de Carrera</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/coordinadores">Coordinadores</a></li>
    <li class="breadcrumb-item active">Cambiar</li>
@endsection
@section('content')

        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Coordinador Actual</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Carrera</th>
                            <td colspan="2"> {{ $coordinador->carrera->nombrecarrera }}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td colspan="2">{{ $coordinador->profesor->nombre1profesor }} {{ $coordinador->profesor->nombre2profesor }} {{ $coordinador->profesor->apellido1profesor }} {{ $coordinador->profesor->apellido2profesor }}</td>

                        </tr>
                        <tr>
                            <th>Fecha de Inicio</th>
                            <td colspan="2">{{ $coordinador->fechainiciocoordinador }}</td>

                        </tr>
                        <tr>
                            <th>Fecha de Fin</th>
                            {{Form::open( ['method'=>"PUT", 'url'=>array("/coordinadores", $coordinador->idcoordinador)])}}
                            <td>
                                <input  style="width: 50%;display: inline" type="text" class="form-control" id="fin" name="fin" value="{{ $coordinador->fechafincoordinador }}">

                                <input  type="hidden" class="form-control" id="activo" name="activo" value="FALSE">

                                <button type="submit" class="btn btn-sm btn-outline-secondary">Finalizar Termino</button>


                                {{ Form::close() }}
                            </td>

                        </tr>

                    </table>
                </div>

                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Coordinador</h3>
                </div>
                <form method="POST" action="/coordinadores">

                    {{ csrf_field() }}
                        <div class="card-body">
                            <table class="table table-bordered">
                            <tr>
                                <th for="carrera">Carrera</th>
                                <td colspan="2">
                                    <input type="text" class="form-control" id="nombrecarrera" name="nombrecarrera" value="{{ $coordinador->carrera->nombrecarrera }}"disabled>
                                </td>
                                <input type="hidden" class="form-control" id="carrera" name="carrera" value="{{ $coordinador->carrera->idcarrera }}">

                            </tr>
                            <tr>
                                <th for="profesor">Profesor</th>
                                <td colspan="2"><select id="profesor" name="profesor" class="form-control select2" style="width: 100%;" >
                                        @if (empty($profesor))
                                            @foreach($profesores as $profesor)
                                                <option value="{{ (string)$profesor->idprofesor }}">{{ $profesor->nombre1profesor }} {{ $profesor->nombre2profesor }} {{ $profesor->apellido1profesor }} {{ $profesor->apellido2profesor }}</option>
                                            @endforeach
                                        @else
                                            @foreach($profesores as $prof)
                                                <option value="{{ $prof->idprofesor }}"
                                                        @if($prof->idprofesor == $profesor->idprofesor)
                                                        selected
                                                        @endif
                                                >{{ $prof->nombre1profesor }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th for="inicio">Fecha de Inicio</th>
                                <td colspan="2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control"id="inicio" name="inicio" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th for="fin">Fecha de Fin</th>
                                <td colspan="2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input id="fin" name="fin" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                </td>
                            </tr>
                    </table>
                        </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>

                        </div>
                    </div>
                </form>
            </div>
            </div>
            </div>
            @include('layouts.errors')

        </div>

@stop