@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Escuelas</li>
@endsection
@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div  class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <h1>ESCUELAS</h1></div>
                                <div class="btn-group mr-2">
                                    <button type="submit"onClick="location.href = 'escuelas/create'" class="btn btn-sm btn-outline-success">NUEVA</button>
                                </div>
                            </div>
                            </div>

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Facultad</th>
                                        <th>Titulacion</th>
                                        <th>Mision</th>
                                        <th>Vision</th>
                                        <th>Duracion</th>
                                        <th>Modalidad</th>
                                        <th>Campo</th>
                                        <th>Titulo</th>


                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($escuelas as $escuela)
                                        <tr>
                                            <td>{{ $escuela->idescuela }}</td>
                                            <td>{{ $escuela->nombreescuela }}</td>
                                            <td>{{ $escuela->descripcionescuela }}</td>
                                            <td>{{ $escuela->nombrefacultad }}</td>
                                            <td>{{ $escuela->titulacionescuela }}</td>
                                            <td>{{ $escuela->misionescuela }}</td>
                                            <td>{{ $escuela->visionescuela }}</td>
                                            <td>{{ $escuela->duracionescuela }}</td>
                                            <td>{{ $escuela->modalidadescuela }}</td>
                                            <td>{{ $escuela->campoescuela }}</td>
                                            <td>{{ $escuela->tituloescuela }}</td>
                                            <td>



                                                <!-- show the nerd (uses the show method found at GET /nerds/{id}
                                                <a class="btn btn-small btn-success" href="{{ URL::to('escuelas/' . $escuela->idescuela) }}">ver
                                                </a>-->
                                                <div class="row">
                                                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <div class="col-sm1">
                                                <a  class="btn btn-link" href="{{ URL::to('escuelas/' . $escuela->idescuela . '/edit') }}">

                                                    <i class="fa fa-pencil"></i>
                                                </a></div>

                                                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                    <div class="col-sm1">
                                                {{ Form::open(array('url' => 'escuelas/' . $escuela->idescuela, 'class' => '')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                    <button type="submit" class="btn btn-link"><i class="fa fa-trash" style="color: #f10407"></i></button>
                                                {{ Form::close() }}
                                                    </div>
                                                </div>

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