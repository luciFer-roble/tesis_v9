@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Sedes</li>
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
                                <h1>SEDES</h1></div>
                                <input type="button" onClick="location.href = 'sedes/create'" class="btn btn-sm btn-outline-secondary" value="NUEVO"></input>
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
                                        <th>Universidad</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sedes as $sede)
                                        <tr>
                                            <td>{{ $sede->idsede }}</td>
                                            <td>{{ $sede->nombresede }}</td>
                                            <td>{{ $sede->descripcionsede }}</td>
                                            <td>{{ $sede->universidad->nombreuniversidad }}</td>
                                            <td>



                                                <!-- show the nerd (uses the show method found at GET /nerds/{id}
                                                <a class="btn btn-small btn-success" href="{{ URL::to('sedes/' . $sede->idsede) }}">ver
                                                </a>-->
                                                <div class="row">
                                                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <div class="col-sm1">
                                                <a  class="btn btn-link" href="{{ URL::to('sedes/' . $sede->idsede . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a></div>

                                                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                    <div class="col-sm1">
                                                {{ Form::open(array('url' => 'sedes/' . $sede->idsede, 'class' => '')) }}
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