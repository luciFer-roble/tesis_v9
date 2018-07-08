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
                            <div class="col-lg-6">
                                <h5>NOMBRE DEL PROYECTO EN EL QUE SE REALIZA LA PRACTICA: </h5>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" value="{{ $practica->tipopractica .' '. $practica->tutore->empresa->nombreempresa}}" readonly>
                            </div>
                        </div>
                        <div class="card-body" id="app">
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
                                    <?php
                                        $cont =0;
                                    ?>
                                    @foreach($actividades as $actividad)
                                        <tr is="actividad" practica="{{ $practica->idpractica }}" :actividad="{{ $actividad }}" >

                                        </tr>
                                        <?php
                                            $cont++;
                                        ?>
                                    @endforeach
                                    @if($cont < 5)
                                    @for($cont; $cont < 5; $cont++)
                                        <tr is="actividad-vacia" practica="{{ $practica->idpractica }}"  >

                                        </tr>
                                    @endfor
                                    @endif

                                    </tbody>
                                    <div>
                                        <?php $pagination_range = 2; ?>
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end">

                                                <li class="page-item {{ $actividades->previousPageUrl()==null ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $actividades->previousPageUrl() ?? '#' }}">Anterior</a>
                                                </li>


                                                @if ($actividades->currentPage() > 1+$pagination_range )

                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $actividades->url(1) ?? '#' }}">{{ 1 }}</a>
                                                    </li>

                                                    @if ($actividades->currentPage() > 1+$pagination_range+1 )
                                                        <li class="page-item disabled">
                                                            <span class="page-link">&hellip;</span>
                                                        </li>
                                                    @endif

                                                @endif

                                                @for ($i=-$pagination_range; $i<=$pagination_range; $i++)

                                                    @if ($actividades->currentPage()+$i > 0 && $actividades->currentPage()+$i <= $actividades->lastPage())
                                                        <li class="page-item {{ $i==0 ? 'active' : '' }}">
                                                            <a class="page-link" href="{{ $actividades->url($actividades->currentPage()+$i) }}">{{ 'Semana '.($actividades->currentPage()+$i) }}</a>
                                                        </li>
                                                    @endif

                                                @endfor

                                                @if ($actividades->currentPage() < $actividades->lastPage()-$pagination_range )

                                                    @if ($actividades->currentPage() < $actividades->lastPage()-$pagination_range-1 )
                                                        <li class="page-item disabled">
                                                            <span class="page-link">&hellip;</span>
                                                        </li>
                                                    @endif

                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $actividades->url($actividades->lastPage()) ?? '#' }}">{{ $actividades->lastPage() }}</a>
                                                    </li>

                                                @endif

                                                <li class="page-item {{ $actividades->nextPageUrl()==null ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $actividades->nextPageUrl() ?? '#' }}">Siguiente</a>
                                                </li>


                                            </ul>
                                        </nav>
                                    </div>

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