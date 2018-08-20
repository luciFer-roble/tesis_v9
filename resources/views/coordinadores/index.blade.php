@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Coordinadores</li>
@endsection

@section('content')
        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">

                            <div class="btn-toolbar mb-2 mb-md-0">
                                <h1>COORDINADORES</h1></div>
                                <div class="btn-group mr-2">
                                <input type="button" onClick="location.href = 'coordinadores/create'" class="btn btn-sm btn-outline-success" value="NUEVO"></input>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Carrera</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coordinadores as $coordinador)
                                        <tr>
                                            <td>{{ $coordinador->profesor->nombresprofesor }} {{ $coordinador->profesor->apellidosprofesor }}</td>
                                            <td>{{ $coordinador->carrera->nombrecarrera }}</td>
                                            <td>{{ $coordinador->fechainiciocoordinador }}</td>
                                            <td>{{ $coordinador->fechafincoordinador }}</td>

                                            <td>



                                                <!-- show the nerd (uses the show method found at GET /nerds/{id}
                                                <a class="btn btn-small btn-success" href="{{ URL::to('coordinadores/' . $coordinador->idcoordinador) }}">ver
                                                </a>-->
                                                <div class="row">
                                                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <div class="col-sm1">
                                                <a  class="btn btn-link" href="{{ URL::to('coordinadores/' . $coordinador->idcoordinador )}}">

                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
                                                <a  class="btn btn-link" href="{{ URL::to('coordinadores/' . $coordinador->idcoordinador . '/change') }}">

                                                    <i class="fa fa-fw fa-exchange"></i>
                                                </a>
                                                    </div>
                                                </div>

                                                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                <!-- we will add this later since its a little more complicated than the other two buttons -->


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


@stop