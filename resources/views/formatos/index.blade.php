@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Formatos</li>
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
                            <h1>FORMATOS</h1></div>
                            <div class="btn-group mr-2">
                                <input type="button" onClick="location.href = 'formatos/create'" class="btn btn-sm btn-outline-success" value="NUEVO"></input>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripcion</th>
                                        <th>Archivo</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($formatos as $formato)
                                 {{--       <tr>
                                            <td>{{ $formato->idtipodocumento }}</td>
                                            <td>{{ $formato->tipodocumento->descripciontipodocumento }}</td>
                                            <td>{{ $formato->archivoformato }}</td>
                                            <td>--}}



                                                <!-- show the nerd (uses the show method found at GET /nerds/{id}
                                                <a class="btn btn-small btn-success" href="{{ URL::to('formatos/' . $formato->idformato) }}">ver
                                                </a>-->
                                                <div class="row">
                                                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                    <div class="col-sm1">
                                                <a  class="btn btn-link" href="{{ URL::to('formatos/' . $formato->idformato . '/edit') }}">

                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a></div>

                                                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                    <div class="col-sm1">
                                                {{ Form::open(array('url' => 'formatos/' . $formato->idformato, 'class' => '')) }}
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


@stop