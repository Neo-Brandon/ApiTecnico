@extends('layouts.app')

@section('content')
<div class="container-xxl d-flex flex-column justify-content-center align-items-center" >
    <div class="welcome text-center">
        <h2><strong>Mostrar Tarea</strong></h2>
        <p>Visualice los datos de la tarea</p>
    </div>

        <table class="table table-hover table-striped w-75 mx-auto"> <!-- Centramos la tabla con w-50 y mx-auto -->
            <tbody>
                <tr>
                    <td><strong>Titulo:</strong></td>
                    <td>{{ $tarea->titulo }}</td> <!-- Mostramos el ID -->
                </tr>
                <tr>
                    <td><strong>Descripción:</strong></td>
                    <td>{{ $tarea->descripcion }}</td> <!-- Mostramos el nombre del tarea -->
                </tr>
                <tr>
                    <td><Strong>Categoria</Strong></td>
                    <td>{{ $tarea->categoria->categoria ?? 'Sin categoría' }}</td>
                </tr>
                <tr>
                    <td><strong>Estado:</strong></td>
                    <td>{{ $tarea->estado->nombre_estado ?? 'Sin categoría' }}</td> <!-- Mostramos el nombre del tarea -->
                </tr>
                <tr>
                    <td><strong>Tecnicos:</strong></td>
                    <td>
                        @if($tarea->usuarios->isNotEmpty())
                            <ul>
                                @foreach ($tarea->usuarios as $usuario)
                                    <li>{{ $usuario->nombre }}</li>
                                @endforeach
                            </ul>
                        @else
                            Sin encargado
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3"> <!-- Centrado del botón -->
            <a class="btn btn-primary w-100" href="{{ route('tarea.index', $tarea->id) }}">Regresar</a> <!-- Ancho del 50% -->
        </div>
    </div>
@endsection
