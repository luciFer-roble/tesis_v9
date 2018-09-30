@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid">
        <!-- Breadcrumbs-->

        @if(Auth::user()->hasRole('coord') )
                <div class="row">
                    <!-- small card -->
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="small-box col-lf-4" style="background-color: #ffdd93">
                            <div class="inner">
                                <h3 class="text-secondary">Practicas Finalizadas</h3>

                                <p>Reporte que muestra los estudiantes que finalizaron sus pr&aacute;cticas en un periodo acad&eacute;mico especifico</p>
                            </div>
                            <div class="icon">
                                <i  data-toggle="modal" data-target="#r1" class="fa fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="small-box col-lf-4" style="background-color: #58dada">
                        <div class="inner">
                            <h3>R2</h3>

                            <p>Prácticas por Periodo Académico</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r2" class="fa fa-chart-line"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="small-box  col-lf-4" style="background-color: #1ca2bb">
                        <div class="inner">
                            <h3>R3</h3>

                            <p>Prácticas por Tipo de Proyecto</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r3" class="fa fa-bar-chart-o"></i>
                        </div>
                    </div>

                </div>
                </div>

                <div class="row">
                    <!-- small card -->
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="small-box col-lf-4" style="background-color: #1fffff">
                        <div class="inner">
                            <h3>R4</h3>

                            <p>Prácticas por Tipo de Empresa</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r4" class="fa fa-file-contract"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="small-box col-lf-4" style="background-color: #ff9d76">
                        <div class="inner">
                            <h3>R5</h3>

                            <p>Prácticas por Sector de la Empresa</p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r5" class="fa fa-chart-area"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="small-box col-lf-4" style="background-color: #ff4273">
                        <div class="inner">
                            <h3>R6</h3>

                            <p>Prácticas por Nivel </p>
                        </div>
                        <div class="icon">
                            <i  data-toggle="modal" data-target="#r6" class="fa fa-pie-chart"></i>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="small-box col-lf-4" style="background-color: #ff4273">
                            <div class="inner">
                                <h3>R6</h3>

                                <p>Estudiantes por Tutor Academico</p>
                            </div>
                            <div class="icon">
                                <i  data-toggle="modal" data-target="#r11" class="fa fa-pie-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        @if(Auth::user()->hasRole('est'))
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="small-box col-lf-4" style="background-color: #1fffff">
                    <div class="inner">
                        <h3>R1</h3>

                        <p>Registro en Base de Datos</p>
                    </div>
                    <div class="icon">
                        <i  data-toggle="modal" data-target="#r7" class="fa fa-pie-chart"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="small-box col-lf-4" style="background-color: #ff9d76">
                    <div class="inner">
                        <h3>R2</h3>

                        <p>L&iacute;neas de Formaci&oacute;n</p>
                    </div>
                    <div class="icon">
                        <i  data-toggle="modal" data-target="#r8" class="fa fa-pie-chart"></i>
                    </div>
                </div>
            </div>
        </div>
            @endif
        @if(Auth::user()->hasRole('prof'))
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="small-box col-lf-4" style="background-color: #D3BFF2">
                    <div class="inner">
                        <h3>R7</h3>

                        <p>Actividades del docente</p>
                    </div>
                    <div class="icon">
                        <i  data-toggle="modal" data-target="#r9" class="fa fa-paperclip"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="small-box col-lf-4" style="background-color: #D291D6">
                    <div class="inner">
                        <h3>R8</h3>

                        <p>Actividades del docente</p>
                    </div>
                    <div class="icon">
                        <i  data-toggle="modal" data-target="#r10" class="fas fa-file-invoice"></i>
                    </div>
                </div>
            </div>
        </div>
@endif

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
                <form method="post" action="/reportes/r2p">
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
                <form method="post" action="/reportes/r3p">
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
                <form method="post" action="/reportes/r4p">
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
                <form method="post" action="/reportes/r5p">
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
                <form method="post" action="/reportes/r6p">
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
    <!-- Modal reporte 7-->
    <div class="modal fade" id="r7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de base de datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r7">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Estudiante:</label>
                            <div class="col-lg-11">
                                <select id="estudiante" name="estudiante" class="form-control">
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->idestudiante }}"
                                        >{{ $estudiante->nombresestudiante .' '.$estudiante->apellidosestudiante  }}</option>
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
    <!-- Modal reporte 8-->
    <div class="modal fade" id="r8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lineas de formacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r8">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Estudiante:</label>
                            <div class="col-lg-11">
                                <select id="estudiante" name="estudiante" class="form-control">
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->idestudiante }}"
                                        >{{ $estudiante->nombresestudiante .' '.$estudiante->apellidosestudiante  }}</option>
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
    <!-- Modal reporte 9-->
    <div class="modal fade" id="r9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actividades del Docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r9">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Profesor:</label>
                            <div class="col-lg-11">
                                <select id="profesor" name="profesor" class="form-control">
                                    @foreach($profesores as $profesor)
                                        <option value="{{ $profesor->idprofesor }}"
                                        >{{ $profesor->nombresprofesor .' '.$profesor->apellidosprofesor  }}</option>
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
    <!-- Modal reporte 10-->
    <div class="modal fade" id="r10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actividades del Docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r10">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Estudiante:</label>
                            <div class="col-lg-11">
                                <select id="estudiante" name="estudiante" class="form-control">
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->idestudiante }}"
                                        >{{ $estudiante->nombresestudiante .' '.$estudiante->apellidosestudiante  }}</option>
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
    <!-- Modal reporte 9-->
    <div class="modal fade" id="r11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actividades del Docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/reportes/r11">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="inicio">Profesor:</label>
                            <div class="col-lg-11">
                                <select id="profesor" name="profesor" class="form-control">
                                    @foreach($profesores as $profesor)
                                        <option value="{{ $profesor->idprofesor }}"
                                        >{{ $profesor->nombresprofesor .' '.$profesor->apellidosprofesor  }}</option>
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