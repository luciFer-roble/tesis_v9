@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Tutores</li>
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
                                <h1>TUTORES</h1></div>
                                <input type="button" onClick="location.href = 'tutores/create'" class="btn btn-sm btn-outline-secondary" value="NUEVO"></input>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tutores as $tutore)
                                        <tr>
                                            <td>{{ $tutore->empresa->nombreempresa }}</td>
                                            <td>{{ $tutore->nombretutore }}</td>
                                            <td>{{ $tutore->apellidotutore }}</td>
                                            <td>{{ $tutore->celulartutore }}</td>
                                            <td>{{ $tutore->correotutore }}</td>
                                            <td>

                                                <div class="row">
                                                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <div class="col-sm1">
                                                        <a  class="btn btn-link" href="{{ URL::to('tutores/' . $tutore->idtutore . '/edit') }}">

                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </a></div>

                                                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                    <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                    <div class="col-sm1">
                                                        {{ Form::open(array('url' => 'tutores/' . $tutore->idtutore, 'class' => '')) }}
                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        <button type="submit" class="btn btn-link"><i class="fa fa-fw fa-trash-alt" style="color: #f10407"></i></button>
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
    </div>

@stop