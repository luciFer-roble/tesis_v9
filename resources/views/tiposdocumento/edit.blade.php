@section('titulo')
    <h1 class="m-0 text-dark">Editar Empresa</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/tiposdocumento">Tipos de Documentos</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
    <div class="container-fluid">
        @extends('layouts.master')
        <div class="row">
            <div class="col-12">
                <div class="card">

            {{Form::open( ['method'=>"PUT", 'url'=>array("/tiposdocumento", $tipodocumento->idtipodocumento)]) }}

                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="formgroup" width="100">
                            <label for="id">Id:</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{ $tipodocumento->idtipodocumento }}">
                        </div>

                        <div class="formgroup">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $tipodocumento->descripciontipodocumento }}">
                        </div>


                    </div>
               <div class="card-footer">
                   <div class="form-group">
                       <button type="submit" class="btn btn-primary">Guardar</button>
                      {{-- <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $tipodocumento->idtipodocumento . '/create') }}">
                           Anadir Tutor
                       </a>
                       <a  class="btn btn-primary" href="{{ URL::to('tutores/' . $tipodocumento->idtipodocumento . '/list') }}">
                           Tutores
                       </a>--}}
                   </div>
               </div>


            </form>

            @include('layouts.errors')
                </div>
            </div>
        </div>
    </div>
@stop