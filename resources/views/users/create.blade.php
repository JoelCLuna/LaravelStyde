@extends('layout')

@section('title', "Crear Usuario")

@section('content')
    <h1 class="header" scope="col" colspan="2">Crear Usuario</h1>

    <form method="POST" action="{{url('usuarios')}}">
        {{csrf_field() }}

        <button type="submit">Crear Usuario</button>
    </form>

    <p><a href="{{url('/usuarios')}}">Regresar</a></p>
@endsection
