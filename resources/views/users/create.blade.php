@extends('layout')

@section('title', "Crear Usuario")

@section('content')
    <h1 class="header" >Crear Usuario</h1>

    <form method="POST" action="{{ url('usuarios') }}">
        {{csrf_field() }}


        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="email">Correo Electronico:</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="pwd">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="pwd">
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox">Recordar Datos
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>

    <p> <a href="{{ route('users.index') }}">Regresar</a></p>
@endsection
