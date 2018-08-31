@extends('layouts.master')
@section('titulo')
    <h1 class="m-0 text-dark">Usuario</h1>
@endsection
@section('nav')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active">{{ Auth::user()->name}}</li>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">


                <!-- Example DataTables Card-->
                <div class="card ">
                    @if(Auth::user()->hasRole('admin'))
                           {{Form::open( ['method'=>"PUT", 'url'=>array("/users", $user->id), 'files'=>true]) }}

                           {{ csrf_field() }}
                           <div class="card-body">
                               <table class="table table-bordered">
                                  <th><strong>Nombre:</strong> </th>
                                   <td>{{ $user->name }}</td>
                                   <th><strong>Correo:</strong></th>
                                   <td>{{ $user->email }}</td>
                                   <td colspan="2">
                                       <div class="form-group">
                                           <div class="image">
                                               <img src="/uploads/avatars/{{$user->avatar}}"
                                                    alt="User Image">

                                           </div>
                                           <div class="input-group">
                                               <div class="custom-file">
                                                   <input type="file" class="" id="foto" name="foto">
                                                   <label for="foto"></label>
                                               </div>

                                           </div>

                                       </div>
                                   </td>
                               </table>
                           </div>
                    @else
                        {{Form::open( ['method'=>"PUT", 'url'=>array("/users", $usuario->id), 'files'=>true]) }}

                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="formgroup" width="100">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}" disabled>
                            </div>

                            <div class="formgroup">
                                <label for="apellido">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $usuario->apellido }}"disabled>
                            </div>

                            <div class="formgroup">
                                <label for="celular">Celular:</label>
                                <input type="text" class="form-control" id="celular" name="celular" value="{{ $usuario->celular}}">
                            </div>

                            <div class="formgroup">
                                <label for="correo">Correo:</label>
                                <input type="text" class="form-control" id="correo" name="correo" value="{{ $usuario->correo }}">
                            </div>
                            <div class="form-group">
                                <div class="image">
                                    <img src="/uploads/avatars/{{$usuario->avatar}}"
                                         alt="User Image">

                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="" id="foto" name="foto">
                                        <label for="foto"></label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endif
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>

                        </div>
                    </div>


                    </form>
                </div>

            </div>
        </div>
    </div>


@stop