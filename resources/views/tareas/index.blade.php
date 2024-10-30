@extends('layouts.app')

@section('title', 'Tareas')

@section('content')
    <style>
        .titulo-perm {
            margin-left: 120pt;
        }

        .estado {
            padding: 5px 10px;
            border-radius: 4px;
            color: #fff;
        }

        .estado.pendiente {
            background-color: #9c9c9c; /* Gris */
        }

        .estado.completada {
            background-color: #65ff65; /* Verde */
        }

        .estado.pospuesta {
            background-color: #ffff5d; /* Amarillo */
        }

        /* Ocultar columnas prescindibles en pantallas pequeñas */
        @media (max-width: 768px) {
            .hide-mobile {
                display: none;
            }

            /* Ajustes en la tabla para pantallas pequeñas */
            .table th, .table td {
                font-size: 0.9rem; /* Reducir el tamaño de fuente */
                padding: 5px; /* Reducir el espaciado */
            }
        }

        /* Para pantallas muy pequeñas (por ejemplo, móviles con menos de 576px de ancho) */
        @media (max-width: 576px) {
            .table th, .table td {
                font-size: 0.8rem; /* Aún más pequeño en pantallas extra pequeñas */
            }

            /* Ocultar aún más contenido en pantallas ultra pequeñas */
            .hide-mobile-xs {
                display: none;
            }
        }
    </style>

    <div class="container-xxl d-flex flex-column justify-content-center align-items-center">
        <div class="welcome text-center">
            <h2><strong>Tareas</strong></h2>
            <p>Registre nuevas tareas para los técnicos</p>
        </div>

        <a type="btn" class="sub-btn-w btn my-custom-btn" href="{{ route('tarea.create') }}">Añadir Tarea</a>
    </div>

    <div class="">
        <table class="table table-striped table-hover table-bordered w-95 mx-auto" style="margin-top: 15pt">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Titulo</th>
                    <th class="text-center hide-mobile">Categoría</th> <!-- Ocultar en móvil -->
                    <th class="text-center hide-mobile hide-mobile-xs">Técnicos</th> <!-- Ocultar en pantallas muy pequeñas -->
                    <th class="text-center">Estado Tarea</th>
                    <th class="text-center hide-mobile">Acciones</th> <!-- Ocultar en móvil -->
                </tr>
            </thead>
            <tbody>
                @foreach ($tareas as $tarea)
                    <tr>
                        <td class="text-center"><strong>{{ $tarea->titulo }}</strong></td>
                        <td class="text-center hide-mobile">
                            {{ $tarea->categoria->categoria ?? 'Sin categoría' }}
                        </td>
                        <td class="text-center hide-mobile hide-mobile-xs">
                            @if($tarea->usuarios->isNotEmpty())
                                <ul>
                                    @foreach ($tarea->usuarios as $usuario)
                                        <li>{{ $usuario->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                Sin encargado
                            @endif
                        </td>
                        <td class="text-center estado {{ strtolower($tarea->estado->nombre_estado) }}">
                            <strong>{{ $tarea->estado->nombre_estado ?? 'Sin estado' }}</strong>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around d-none d-md-flex">
                                <a class="btn my-custom-btn flex-grow-1 mx-1"
                                    href="{{ route('tarea.show', $tarea->id) }}">Mostrar</a>
                        
                                <a class="btn btn-success flex-grow-1 mx-1"
                                    href="{{ route('tarea.edit', $tarea->id) }}">Modificar</a>
                        
                                <form action="{{ route('tarea.destroy', $tarea->id) }}" method="POST" class="flex-grow-1 mx-1">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger w-100" type="submit">Eliminar</button>
                                </form>
                            </div>
                        
                            <!-- Dropdown para pantallas pequeñas -->
                            <div class="dropdown d-block d-md-none">
                                <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton{{ $tarea->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton{{ $tarea->id }}">
                                    <li><a class="dropdown-item" href="{{ route('tarea.show', $tarea->id) }}">Mostrar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tarea.edit', $tarea->id) }}">Modificar</a></li>
                                    <li>
                                        <form action="{{ route('tarea.destroy', $tarea->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit">Eliminar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    {{ $tareas->links('vendor.pagination.bootstrap-4') }}
@endsection
