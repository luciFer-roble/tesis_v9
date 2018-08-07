@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid">
        <!-- Breadcrumbs-->

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- small card -->
                    <div class="small-box bg-info col-md-3">
                        <div class="inner">
                            <h3>R1</h3>

                            <p>Estudiantes que finalizaron Practicas</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r1" class="fa fa-baseball-ball"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            info &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    <div class="small-box bg-warning col-md-3">
                        <div class="inner">
                            <h3>R2</h3>

                            <p>Descripcion...</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r2" class="fa fa-baseball-ball"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            info &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    <div class="small-box bg-danger col-md-3">
                        <div class="inner">
                            <h3>R3</h3>

                            <p>Descripcion...</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r3" class="fa fa-baseball-ball"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            info &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    <div class="small-box bg-success col-md-3">
                        <div class="inner">
                            <h3>R4</h3>

                            <p>Descripcion...</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r4" class="fa fa-baseball-ball"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            info &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="r1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudiantes que culminaron</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r1">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-10 control-label" for="inicio">Fecha de Inicio:</label>
                        <div class="col-lg-11">
                            <select id="periodor1" name="periodor1" class="form-control">
                                @foreach($periodos as $periodo)
                                    <option value="{{ $periodo->idperiodoacademico }}"
                                    >{{ $periodo->descripcionperiodoacademico  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Mostrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@stop