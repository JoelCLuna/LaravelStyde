@extends('layout')

@section('title', 'Usuarios')

@section('content')
    <h1>{{ $title }}</h1>

<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo Electronico</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->email }} </th>
        </tr>

        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </tbody>
</table>
    @endsection

@section('sidebar')
    @parent
@endsection