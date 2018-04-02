@include('header')
    <h1>{{$title}}</h1>

    <!-- unless es un condicional inverso-->

    <ul>
        @forelse ($users as $user)
            <li>{{ $user }}</li>
        @empty
            <li>No hay usuarios registrados.</li>
       @endforelse

    </ul>

@include('footer')