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
                                        <th class="p-0 m-0">Nombre</th>
                                        <th class="p-0 m-0">Carrera</th>
                                        <th class="p-0 m-0">Fecha Inicio</th>
                                        <th class="p-0 m-0">Fecha Fin</th>
                                        <td class="p-0 m-0"></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coordinadores as $coordinador)
                                        <tr>
                                            <td class="p-0 m-0">{{ $coordinador->profesor->nombresprofesor }} {{ $coordinador->profesor->apellidosprofesor }}</td>
                                            <td class="p-0 m-0">{{ $coordinador->carrera->nombrecarrera }}</td>
                                            <td class="p-0 m-0">{{ $coordinador->fechainiciocoordinador }}</td>
                                            <td class="p-0 m-0">{{ $coordinador->fechafincoordinador }}</td>

                                            <td class="p-0 m-0" style="width: 7%">



                                                <!-- show the nerd (uses the show method found at GET /nerds/{id}
                                                <a class="btn btn-small btn-success" href="{{ URL::to('coordinadores/' . $coordinador->idcoordinador) }}">ver
                                                </a>-->
                                                <div class="row p-0 m-0">
                                                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <div class="col">
                                                <a  class="btn btn-link p-0 m-0" href="{{ URL::to('coordinadores/' . $coordinador->idcoordinador )}}">

                                                    <i class="fa fa-external-link-alt" ></i>
                                                </a>
                                                    </div>
                                                    <div class="col">
                                                <a  class="btn btn-link p-0 m-0" href="{{ URL::to('coordinadores/' . $coordinador->idcoordinador . '/change') }}">

                                                    <i class="fa fa-toggle-off" title="Cambiar de Coordinador"></i>
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