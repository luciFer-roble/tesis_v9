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
                                @if(Auth::user()->hasRole('admin'))
                            <div class="btn-group mr-2">
                                <input type="button" onClick="location.href = 'empresas/create'" class="btn btn-sm btn-outline-success" value="NUEVA">
                            </div>
                                    @endif
                        </div>
                        </div>
                        <div class="card-body" id="app">
                            {{ $empresas->links() }}
                                @if(Auth::user()->hasRole('admin'))
                                <div class="table-responsive" id="app">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="p-0 m-0">Nombre</th>
                                        <th class="p-0 m-0">Direccion</th>
                                        <th class="p-0 m-0">Sector</th>
                                        <th class="p-0 m-0">Telefono</th>
                                        <td class="p-0 m-0"></td>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($empresas as $empresa)
                                            <tr>
                                                <td class="p-0 m-0">{{ $empresa->nombreempresa }}</td>
                                                <td class="p-0 m-0">{{ $empresa->direccionempresa }}</td>
                                                <td class="p-0 m-0">{{ $empresa->sectorempresa }}</td>
                                                <td class="p-0 m-0">{{ $empresa->telefonoempresa }}</td>
                                                <td class="p-0 m-0" style="width: 7%">
                                                    <div class="row p-0 m-0">
                                                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                        <div class="col">
                                                    <a  class="btn btn-link p-0 m-0" href="{{ URL::to('empresas/' . $empresa->idempresa . '/edit') }}">

                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </a></div>

                                                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                    <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                        <div class="col">
                                                    {{ Form::open(array('url' => 'empresas/' . $empresa->idempresa, 'class' => '')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                        <button type="submit" class="btn btn-link p-0 m-0"><i class="fa fa-fw fa-trash-alt" style="color: #f10407"></i></button>
                                                    {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                </div>
                                @else
                                        <div class="table-responsive">
                                            @foreach($empresas as $empresa)
                                                <empresa-item  :empresa="{{ $empresa }}" :convenios="{{ $convenios }}">
                                                </empresa-item>
                                            @endforeach
                                        </div>
                                @endif

                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>

                </div>
            </div>
        </div>


@stop