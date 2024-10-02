@extends('layouts.app')

@section('content')
    <div class="container text-center"> <!-- Centrado del contenido -->
        <div class="mb-4">
            <h1>Datos del Permiso</h1>
        </div>

        <table class="table table-hover table-striped w-50 mx-auto"> <!-- Centramos la tabla con w-50 y mx-auto -->
            <tbody>
                <tr>
                    <td><strong>ID:</strong></td>
                    <td>{{ $permiso->id }}</td> <!-- Mostramos el ID -->
                </tr>
                <tr>
                    <td><strong>Nombre:</strong></td>
                    <td>{{ $permiso->tipo_permiso }}</td> <!-- Mostramos el nombre del permiso -->
                </tr>
            </tbody>
        </table>

        <div class="mt-3"> <!-- Centrado del botón -->
            <a class="btn btn-primary w-50" href="{{ route('permiso.index', $permiso->id) }}">Regresar</a> <!-- Ancho del 50% -->
        </div>
    </div>
@endsection
