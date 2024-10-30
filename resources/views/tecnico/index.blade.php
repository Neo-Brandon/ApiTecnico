<!--tecnico/index.blade.php -->

@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <div class="">
        <div class="welcome">
            <h2><strong>Bienvenido {{ Auth::user()->name }}</strong></h2>
            <p>Aquí puede revisar sus tareas</p>
        </div>

        <div class="task-container">
            <!-- Se añadirán tareas con ayuda del javascript aquí -->
        </div>
        <!-- Referenciamos JS -->
        <script src="{{ asset('myResource/js/tecnicoIndex.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('myResource/css/tecnicoIndex.css') }}" />
@endsection
