@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="container text-center"> <!-- Centrado del contenido -->
        <div class="mb-4">
            <h1>Datos de {{ $usuario->name }}</h1>
        </div>

        <table class="table table-hover table-striped w-50 mx-auto"> <!-- Centramos la tabla con w-50 y mx-auto -->
            <tbody>
                <tr>
                    <td><strong>ID:</strong></td>
                    <td>{{ $usuario->id }}</td> <!-- Mostramos el ID -->
                </tr>
                <tr>
                    <td><strong>Nombre:</strong></td>
                    <td>{{ $usuario->name }}</td> <!-- Mostramos el nombre del usuario -->
                </tr>
                <tr>
                    <td><strong>Correo:</strong></td>
                    <td>{{ $usuario->email }}</td> <!-- Mostramos el nombre del usuario -->
                </tr>
                <tr>
                    <td><strong>Contraseña:</strong></td>
                    <td>{{ $usuario->password }}</td> <!-- Mostramos el nombre del usuario -->
                </tr>
            </tbody>
        </table>

        <div class="mt-3"> <!-- Centrado del botón -->
            <a class="btn btn-primary w-50" href="{{ route('usuario.index', $usuario->id) }}">Regresar</a> <!-- Ancho del 50% -->
        </div>
    </div>
@endsection
