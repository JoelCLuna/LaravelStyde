@extends('layout')

@section('title', "Crear Usuario")

@section('content')
 <div class="card">
    <h4 class="card-header">Crear usuario</h4>
    <div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corrige los siguientes errores:</h6>
             <ul>
                 @foreach($errors->all() as $error)
                     <li>{{$error}}</li>
                 @endforeach
             </ul>
        </div>
    @endif

    <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
        {{method_field('PUT')}}
        {{csrf_field() }}

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Joel Celaya" value="{{old('name', $user->name)}}">
        </div>
        <div class="form-group">
            <label for="email">Correo Electronico:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="sucorreo@example.com" value="{{old('email', $user->email)}}">
        </div>
        <div class="form-group">
            <label for="pwd">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="pwd" placeholder="Mayor a 6 caracteres">
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox">Recordar Datos
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        <a href="{{ route('users.index') }}"  class="btn btn-link">Regresar a lista de usuarios</a>
    </form>
    </div>
 </div>


@endsection
