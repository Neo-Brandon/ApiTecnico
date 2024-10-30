@extends('layouts.app')

@section('title', 'Agregar')

@section('content')

    <div class="container">
        <div class="welcome">
            <h2><strong>Agregar</strong></h2>
            <p>Aqui puede añadir a las diferentes categorias</p>
        </div>

        <div class="grid">
            <div class="grid-item">
                <a href="{{ route("tarea.create") }}">
                    <img src="{{ asset('icons/tarea.png') }}" alt="Añadir Tarea">
                    <p>Añadir Tarea</p>
                </a>
            </div>
            <div class="grid-item">
                <a href="{{ route("usuario.create") }}">
                    <img src="{{ asset('icons/usuario.png') }}" alt="Añadir Usuario">
                    <p>Añadir Usuario</p>
                </a>
            </div>
            <div class="grid-item">
                <a href="{{route("categoria.create")}}">
                    <img src="{{ asset('icons/categoria.png') }}" alt="Añadir Categoria">
                    <p>Añadir categorias</p>
                </a>
            </div>
            <div class="grid-item">
                <img src="{{ asset('icons/ayuda.png') }}" alt="Ayuda">
                <p>Ayuda</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

@endsection