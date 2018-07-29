@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Empresas</li>
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
                            <h1>EMPRESAS</h1></div>

                        </div>
                        </div>
                        <div class="card-body" id="app">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Direccion</th>
                                        <th>Sector</th>
                                        <th>Telefono</th>
                                        <th>Convenio</th>
                                        <td>Sede</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($empresas as $empresa)
                                        <tr is="empresa-item"  :empresa="{{ $empresa }}">

                                        </tr>
                                    @endforeach

                                    {{--lo comentado de abajo es para probar el join:--}}
                                   {{-- @foreach($empresas as $empresa)
                                         <tr>
                                            <td>{{ $empresa->nombreempresa }}</td>
                                            <td>{{ $empresa->direccionempresa }}</td>
                                            <td>{{ $empresa->sectorempresa }}</td>
                                             <td>{{ $empresa->telefonoempresa }}</td>
                                             <td>{{ $empresa->idconvenio }}</td>
                                             <td>{{ $empresa->nombresede }}</td>


                                        </tr>
                                    @endforeach--}}
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