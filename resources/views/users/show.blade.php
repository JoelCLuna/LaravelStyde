@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')


<table class="table table-striped">
    <thead class="thead-dark">
       <tr>
            <th class="header" scope="col" colspan="2">Mostrando detalles de {{ $user->name }}</th>
       </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="col">Usuario #</th>
        <th scope="row">{{ $user->id }}</th>
    </tr>
    <tr>
        <th scope="col">Nombre</th>
        <th>{{ $user->name }}</th>
    </tr>
    <tr>
        <th scope="col">Correo Electronico</th>
        <th>{{ $user->email }} </th>
    </tr>
    </thead>
    </tbody>
</table>
    <p>
        <a href="{{url('/usuarios')}}"  class="btn btn-link">Regresar</a>
    </p>
@endsection
