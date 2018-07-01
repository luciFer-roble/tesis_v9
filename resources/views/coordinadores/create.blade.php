@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Nuevo Coordinador</h1>
    @endsection
@section('nav')
<li class="breadcrumb-item"><a href="/">Inicio</a></li>
<li class="breadcrumb-item"><a href="/coordinadores">Coordinadores</a></li>
<li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nuevo Coordinador</h3>
                        </div>
                        <form method="POST" action="/coordinadores">
                            <table class="table table-bordered">

                                {{ csrf_field() }}
                                <tr>
                                    <th for="carrera">Carrera:</th>
                                    <td>
                                        <select id="carrera" name="carrera" class="form-control select2" style="width: 100%;" >
                                            @if (empty($carrera))
                                                @foreach($carreras as $carrera)
                                                    <option value="{{ (string)$carrera->idcarrera }}">{{ $carrera->nombrecarrera }}</option>
                                                @endforeach
                                            @else
                                                @foreach($carreras as $car)
                                                    <option value="{{ $car->idcarrera }}"
                                                            @if($car->idcarrera == $carrera->idcarrera)
                                                            selected
                                                            @endif
                                                    >{{ $car->nombrecarrera }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <th for="profesor">Profesor:</th>
                                    <td><select id="profesor" name="profesor" class="form-control select2" style="width: 100%;" >
                                            @if (empty($profesor))
                                                @foreach($profesores as $profesor)
                                                    <option value="{{ (string)$profesor->idprofesor }}">{{ $profesor->nombre1profesor }}</option>
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
                                    <th for="inicio">Fecha de Inicio:</th>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control"id="inicio" name="inicio" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th for="fin">Fecha de Fin:</th>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input id="fin" name="fin" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <hr>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="activo" name="activo" value="true">
                                <button type="submit" class="btn btn-primary">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        {{--    <div class="row">
                <div class="col-12">
                    <div class="card">
            <form method="POST" action="/coordinadores">

                {{ csrf_field() }}
                <div class="formgroup" width="100">
                    <label for="carrera">Carrera:</label>
                    <select id="carrera" name="carrera" class="form-control select2" style="width: 100%;" >
                        @if (empty($carrera))
                            @foreach($carreras as $carrera)
                                <option value="{{ (string)$carrera->idcarrera }}">{{ $carrera->nombrecarrera }}</option>
                            @endforeach
                        @else
                            @foreach($carreras as $car)
                                <option value="{{ $car->idcarrera }}"
                                        @if($car->idcarrera == $carrera->idcarrera)
                                        selected
                                        @endif
                                >{{ $car->nombrecarrera }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="formgroup" width="100">
                    <label for="profesor">Profesor:</label>
                    <select id="profesor" name="profesor" class="form-control select2" style="width: 100%;" >
                        @if (empty($profesor))
                            @foreach($profesores as $profesor)
                                <option value="{{ (string)$profesor->idprofesor }}">{{ $profesor->nombre1profesor }}</option>
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
                </div>
                <div class="formgroup" >
                    <label for="inicio">Fecha de Inicio:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control"id="inicio" name="inicio" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>
                </div>

                <div class="formgroup">
                    <label for="fin">Fecha de Fin:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input id="fin" name="fin" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                        </div>
                </div>
                <hr>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="activo" name="activo" value="true">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
                @include('layouts.errors')
                    </div>
                </div>
            </div>--}}


        </div>

@stop