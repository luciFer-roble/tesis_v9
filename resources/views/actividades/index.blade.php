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
                            <input type="text" class="form-control"  >
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>DESCRIPCION DE ACTIVIDADES</th>
                                        <th></th>
                                        <th>CONTROL</th>
                                        <th>COMENTARIO</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--@foreach($practicas as $practica)

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
    </div>
@stop
