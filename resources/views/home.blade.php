@extends('layouts.master')

@section('content')
<div class="">
    <div class="row" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="app">
                    <div class="row">
                        <div class="col-md-12">
                            <consulta-praticas></consulta-praticas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <chart-reporte6></chart-reporte6>
                        </div>
                        <div class="col-md-6">
                            <chart-reporte2></chart-reporte2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
