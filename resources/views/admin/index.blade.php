@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="welcome">
            <h2><strong>Bienvenido Administrador</strong></h2>
            <p>Toque cualquier recuadro para desplegar</p>
        </div>

        <div class="grid">
            <div class="grid-item">
                <a href="{{ route("tarea.create") }}">
                    <img src="{{ asset('icons/tarea.png') }}" alt="Asignar Tarea">
                    <p>Asignar tarea</p>
                </a>
            </div>
            <div class="grid-item">
                <a href="{{ route("tarea.index") }}">
                    <img src="{{ asset('icons/ojo.png') }}" alt="Comprobar Tareas">
                    <p>Comprobar tareas</p>
                </a>
            </div>
            <div class="grid-item">
                <a href="">
                    <img src="{{ asset('icons/estadistica.png') }}" alt="Estadísticas">
                    <p>Estadísticas</p>
                </a>
            </div>
            <div class="grid-item">
                <a href="{{ url('/admin/añadir') }}">
                <img src="{{ asset('icons/agregar.png') }}" alt="Añadir">
                <p>Añadir</p>
                </a>
            </div>
            <div class="grid-item">
                <img src="{{ asset('icons/ayuda.png') }}" alt="Ayuda">
                <p>Ayuda</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
@endsection