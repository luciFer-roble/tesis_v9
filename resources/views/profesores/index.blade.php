@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Profesores</li>
@endsection

@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <h1>PROFESORES</h1></div>
                                <input type="button" onClick="location.href = 'profesores/create'" class="btn btn-sm btn-outline-secondary" value="NUEVO"></input>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Primer Nombre</th>
                                        <th>Segundo Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Correo</th>
                                        <th>Celular</th>
                                        <th>Oficina</th>
                                        <th>Escuela</th>
                                        <td colspan="3"></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($profesores as $profesor)
                                        <tr>
                                            <td class="p-1 m-0">{{ $profesor->idprofesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->nombre1profesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->nombre2profesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->apellido1profesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->apellido2profesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->correoprofesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->celularprofesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->oficinaprofesor }}</td>
                                            <td class="p-1 m-0">{{ $profesor->escuela->nombreescuela }}</td>
                                            <td>
                                                <a  class="btn btn-link" href="{{ URL::to('profesores/' . $profesor->idprofesor . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i></a>
                                            </td>
                                            <td>{{ Form::open(array('url' => 'profesores/' . $profesor->idprofesor, 'class' => '')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <button type="submit" class="btn btn-link"><i class="fa fa-fw fa-trash-alt" style="color: #0aeff1"></i></button>
                                                {{ Form::close() }}</td>

                                        </tr>
                                    @endforeach
                                        <form method="POST" action="/profesores">

                                            {{ csrf_field() }}
                                        <tr>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="id" name="id"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="nombre1" name="nombre1"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="nombre2" name="nombre2"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="apellido1" name="apellido1"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="apellido2" name="apellido2"></td>
                                            <td class="p-0 m-0"><select id="escuela" name="escuela" class="form-control">
                                                    @foreach($escuelas as $escuela)
                                                        <option value="{{ $escuela->idescuela }}">{{ $escuela->nombreescuela }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="celular" name="celular"></td>
                                            <td class="p-0 m-0"><input type="text" class="form-control" id="correo" name="correo"></td>
                                            <td class="p-0 m-0"><input type="date" class="form-control" id="oficina" name="oficina"></td>

                                            <td class="p-0 m-0" colspan="3"><button type="submit" class="btn btn-primary btn-block">Insertar</button></td>
                                        </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop