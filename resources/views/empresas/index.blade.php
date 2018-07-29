@extends('layouts.master')
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item">Empresas</li>
@endsection

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <div class="row">
                <div class="col-12" >

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <h1>EMPRESAS</h1></div>
                            <div class="btn-group mr-2">
                                <input type="button" onClick="location.href = 'empresas/create'" class="btn btn-sm btn-outline-success" value="NUEVA">
                            </div>
                        </div>
                        </div>
                        <div class="card-body">

                                @if(Auth::user()->hasRole('admin'))
                                <div class="table-responsive" id="app">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Sector</th>
                                        <th>Telefono</th>
                                        <td></td>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($empresas as $empresa)
                                            <tr>
                                                <td>{{ $empresa->nombreempresa }}</td>
                                                <td>{{ $empresa->direccionempresa }}</td>
                                                <td>{{ $empresa->sectorempresa }}</td>
                                                <td>{{ $empresa->telefonoempresa }}</td>
                                                <td>
                                                    <div class="row">
                                                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                        <div class="col-sm1">
                                                    <a  class="btn btn-link" href="{{ URL::to('empresas/' . $empresa->idempresa . '/edit') }}">

                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a></div>

                                                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                    <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                        <div class="col-sm1">
                                                    {{ Form::open(array('url' => 'empresas/' . $empresa->idempresa, 'class' => '')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                        <button type="submit" class="btn btn-link"><i class="fa fa-fw fa-trash-alt" style="color: #f10407"></i></button>
                                                    {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                </div>
                                @endif

                                @if(Auth::user()->hasRole('coord'))

                                        <div class="table-responsive" id="app">
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

                                                {{--@php--}}
                                                    {{--var_dump($empresa); exit();--}}
                                                {{--@endphp--}}
                                                <tr is="empresa-item"  :empresa="{{ $empresa }}" :convenios="{{ $convenios }}" >

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
                                @endif
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>


@stop