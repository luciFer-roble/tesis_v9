@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Tutores</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12">
                    <!-- Example DataTables Card-->
                    <div class="card mb-3" id="app">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <h1>TUTORES</h1></div>
                            <div class="btn-group mr-2">
                            <tutores-nuevo></tutores-nuevo>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="p-0 m-0">Empresa</th>
                                        <th class="p-0 m-0">Nombre</th>
                                        <th class="p-0 m-0">Apellido</th>
                                        <th class="p-0 m-0">Celular</th>
                                        <th class="p-0 m-0">Correo</th>
                                        <td class="p-0 m-0"></td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tutores as $tutore)

                                        <tr is="tutores-componente" :tutore="{{ $tutore }}" :empresa="{{ $tutore->empresa }}"></tr>
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