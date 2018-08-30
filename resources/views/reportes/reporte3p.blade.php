@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Reportes</li>
@endsection

@section('content')

    <div class="container-fluid" id="app">
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <h3>{{ $tipopractica }}</h3></div>

                    <div class="btn-group mr-2 float-right">
                         <span  data-toggle="modal" data-target="#modal1"
                                class="btn btn-sm btn-light" ><i class="fas fa-chart-bar"></i>&nbsp;GRAFICO</span>&nbsp;
                        <span onClick="location.href = '/reportes/{{ $tipopractica }}/descarga3'"
                              class="btn btn-sm btn-outline-success" ><i class="fas fa-download"></i>&nbsp;EXCEL</span>
                    </div>

                </div>
                `
            </div>
            <div class="card-body p-0 m-0" id="app">

                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="m-0 p-0">No.</th>
                            <th class="m-0 p-0">Estudiante</th>
                            <th class="m-0 p-0">Inicio</th>
                            <th class="m-0 p-0">Fin</th>
                            <th class="m-0 p-0">Tipo de proyecto</th>
                            <th class="m-0 p-0"># Horas</th>
                            <th class="m-0 p-0">Empresa</th>
                            <th class="m-0 p-0">Tipo Empresa</th>
                            <th class="m-0 p-0">Sector</th>
                            <th class="m-0 p-0">Tutor Academico</th>
                            <th class="m-0 p-0">Tutor Empresarial</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($practicas as $practica)
                            <tr>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->idpractica }}</span></td>
                                <td class="m-0 p-0"> <a  class="btn btn-link m-0 p-0 border-0" href="{{ URL::to('estudiantes/' . $practica->idestudiante) }}" >{{ $practica->estudiante->nombresestudiante.' '.$practica->estudiante->apellidosestudiante}}</a></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->fechainiciopractica }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->fechafinpractica }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tipopractica }}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->horaspractica }}</span></td>
                                <td class="m-0 p-0"><a  class="btn btn-link  m-0 p-0" href="{{ URL::to('empresas/' . $practica->tutore->idempresa) }}" >{{ $practica->tutore->empresa->nombreempresa}}</a></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tutore->empresa->tipoempresa}}</span></td>
                                <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ $practica->tutore->empresa->sectorempresa}}</span></td>
                                <td class="m-0 p-0"><a  class="btn btn-link  m-0 p-0" href="{{ URL::to('profesores/' . $practica->idprofesor) }}" >{{ $practica->profesor->nombresprofesor.' '.$practica->profesor->apellidosprofesor }}</a></td>
                                <td class="m-0 p-0"><a  class="btn btn-link  m-0 p-0" href="{{ URL::to('tutores/' . $practica->idtutore) }}" >{{ $practica->tutore->nombretutore.' '.$practica->tutore->apellidotutore }}</a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal reporte 3-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <chart-reporte3></chart-reporte3>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Imprimir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop