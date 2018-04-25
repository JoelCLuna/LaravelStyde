@extends('layout')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">

        <h1 class="pb-1">{{ $title }}</h1>
        <p><a  class="btn btn-primary" href="{{ route('users.create') }}"> Nuevo Usuario</a> </p>

    </div>

    @if ($users->isNotEmpty())
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo Electronico</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar Usuario</th>
            <th scope="col">Eliminar</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <th>{{ $user->name }}</th>
                <th>{{ $user->email }} </th>
                <th><a class="btn btn-link" href="{{ route('users.show', $user) }}"><span class="oi oi-eye"></span></a></th>
                <th><a class="btn btn-link" href="{{ route('users.edit', $user) }}"><span class="oi oi-pencil"></span></a> </th>
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <th><button class="btn btn-link" type="submit"><span class="oi oi-trash"></span></button> </th>
                </form>

            </tr>
        @empty
            <li>No hay usuarios registrados.</li>
            @endforelse
        </tbody>
    </table>
@else
    <li>No hay usuarios registrados.</li>
@endif
    @endsection

@section('sidebar')
    @parent
@endsection