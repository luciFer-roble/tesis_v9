@extends('layouts.master')

@section('content')
    <div class="my-4 w-100" id="myChart" width="50%" height="380">

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">
                    <div class="row">

                    </div>

                    <!-- DataTable Card-->
                    <div class="card mb-3">
                        <div class="card-header row">
                            <h1>NOMBRE DEL PROYECTO EN EL QUE SE REALIZA LA PRACTICA: </h1>
                            <input type="text" class="form-control" value="{{ $practica->tipopractica .' '. $practica->tutore->empresa->nombreempresa}}" >
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Estudiante</th>
                                        <th>Empresa</th>
                                        <th>Tutor empresarial</th>
                                        <th>Tutor academico</th>
                                        <th>Tipo</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($practicas as $practica)
                                        <tr>
                                            <td class="p-1 m-0">{{ $practica->idpractica }}</td>
                                            <td class="p-1 m-0">{{ $practica->estudiante->nombre1estudiante .' '. $practica->estudiante->apellido1estudiante }}</td>
                                            <td class="p-1 m-0">{{ $practica->tutore->empresa->nombreempresa }}</td>
                                            <td class="p-1 m-0">{{ $practica->profesor->nombre1profesor .' '. $practica->profesor->apellido1profesor }}</td>
                                            <td class="p-1 m-0">{{ $practica->tutore->nombretutore .' '. $practica->tutore->apellidotutore }}</td>
                                            <td class="p-1 m-0">{{ $practica->tipopractica }}</td>
                                            <td class="p-1 m-0">{{ $practica->fechainiciopractica }}</td>
                                            <td class="p-1 m-0">{{ $practica->fechafinpractica }}</td>
                                            <td>
                                                <a  class="btn btn-link" href="{{ URL::to('practicas/' . $practica->idpractica . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

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