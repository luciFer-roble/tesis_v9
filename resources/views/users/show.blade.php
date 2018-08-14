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
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                       {{Form::open( ['method'=>"PUT", 'url'=>array("/users", $user->id), 'files'=>true]) }}

                            {{ csrf_field() }}
                                <div class="card-body">
                                    <p>
                                        <strong>Nombre:</strong> {{ $user->name }}<br>
                                        <strong>Correo:</strong> {{ $user->email }}<br>
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



                                    </p>
                                </div>
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