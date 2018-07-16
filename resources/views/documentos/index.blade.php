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
                                <h5>{{ $practica->tipopractica .' '. $practica->tutore->empresa->nombreempresa}}</h5>
                            </div>
                        </div>
                        <div class="card-body" id="app">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>TIPO</th>
                                        <th>DOCUMENTO</th>
                                        <th>ESTADO</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tiposdocumento as $tipo)
                                        @php
                                            $documento = null;
                                            $codigo =null;
                                            $documentop =null;
                                        @endphp
                                        @foreach($documentosp as $doc)
                                            @if($doc->idtipodocumento == $tipo->idtipodocumento)
                                                @php
                                                    $documento = $doc->archivodocumentop;
                                                    $codigo = $doc->iddocumentop;
                                                $documentop = $doc;
                                                @endphp
                                            @endif
                                        @endforeach

                                        <tr is="documentop" :practica="{{ $practica }}" :tipo="{{ $tipo }}"  documento="{{ $documento }}" codigo="{{ $codigo }}" >

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