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

                            <p>Practicas por periodo academico</p>
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

                            <p>Estudiantes/practicas por tipo de proyecto</p>
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

                            <p>Estudiantes/practicas por tipo de empresa</p>
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
        </div><div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- small card -->
                    <div class="small-box bg-secondary col-md-3">
                        <div class="inner">
                            <h3>R5</h3>

                            <p>Practicas por sector de la empresa</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r5" class="fa fa-baseball-ball"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            info &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    <div class="small-box bg-primary col-md-3">
                        <div class="inner">
                            <h3>R6</h3>

                            <p>Practicas por nivel </p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r6" class="fa fa-baseball-ball"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            info &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    <div class="small-box bg-white col-md-3">
                        <div class="inner">
                            <h3>R7</h3>

                            <p>Empresas con convenio</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r7" class="fa fa-baseball-ball"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            info &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    <div class="small-box bg-success col-md-3">
                        <div class="inner">
                            <h3>R4</h3>

                            <p>Estudiantes/practicas por tipo de empresa</p>
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

    <!-- Modal reporte 1-->
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

    <!-- Modal reporte 2-->
    <div class="modal fade" id="r2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Practicas por Periodo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r2">
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



    <!-- Modal reporte 3-->
    <div class="modal fade" id="r3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listar por tipo de proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r3">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Tipo:</label>
                            <div class="col-lg-11">
                                <select id="tipopractica" name="tipopractica" class="form-control">
                                    <option value="Pasantia">Pasantia</option>
                                    <option value="Practica">Practica Pre Profesional</option>
                                    <option value="Proyecto">Proyecto</option>
                                    <option value="Ayudantia">Ayudantia</option>
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

    <!-- Modal reporte 4-->
    <div class="modal fade" id="r4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listar por tipo de Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r4">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Tipo:</label>
                            <div class="col-lg-11">
                                <select id="tipoempresa" name="tipoempresa" class="form-control">
                                    <option value="Publica">Publica</option>
                                    <option value="Privada">Privada</option>
                                    <option value="Empresa Sin Fines de Lucro">Empresa Sin Fines de Lucro</option>
                                    <option value="Organismo Internacional">Organismo Internacional</option>
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


    <!-- Modal reporte 5-->
    <div class="modal fade" id="r5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listar por sector de la Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r5">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Sector:</label>
                            <div class="col-lg-11">
                                <select id="sector" name="sector" class="form-control">
                                    <option value="Primario">Primario</option>
                                    <option value="Secundario">Secundario</option>
                                    <option value="Terciario">Terciario</option>
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


    <!-- Modal reporte 6-->
    <div class="modal fade" id="r6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listar practicas por nivel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r6">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Nivel:</label>
                            <div class="col-lg-11">
                                <select id="nivel" name="nivel" class="form-control">
                                    @foreach($niveles as $nivel)
                                        <option value="{{ $nivel->idnivel }}"
                                        >{{ $nivel->nombrenivel  }}</option>
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