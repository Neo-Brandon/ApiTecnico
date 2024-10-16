@extends('layouts.app')

@section('content')
    <style>
        .titulo-perm {
            margin-left: 120pt;
        }

        /* Hacer la tabla responsiva */
        @media (max-width: 768px) {
            .table thead {
                display: none; /* Ocultar encabezado en pantallas pequeñas */
            }
            .table tbody tr {
                display: block;
                margin-bottom: 15px;
            }
            .table tbody td {
                display: flex;
                justify-content: space-between;
                padding-left: 50%;
                position: relative;
            }
            .table tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                
            }
            .table tbody td:last-child {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            /* Ajustar el contenedor para que no cause desplazamiento horizontal */
            .container-xxl, .d-flex {
                width: 100%;
                padding-left: 15px;
                padding-right: 15px;
                margin: 0;
            }

            /* Asegurarse de que la tabla no cause desplazamiento horizontal */
            .table {
                width: 100%;
            }
        }

        .table tbody td {
            overflow-wrap: break-word; /* Permitir que las palabras largas se rompan */
            word-wrap: break-word; /* Compatibilidad con navegadores más antiguos */
            white-space: normal; /* Permitir que el texto fluya en múltiples líneas */
        }

        /* Quitar el scroll en la tabla */
        .table-container {
            overflow: visible;
            max-height: none;
        }
        .selected {
            background-color: #343a40; /* Gris oscuro */
            color: #fff; /* Blanco */
        }

    </style>

    <div class="container-xxl d-flex flex-column justify-content-center align-items-center">
        <div class="welcome text-center">
            <h2><strong>Usuarios</strong></h2>
            <p>Registre nuevos técnicos o administradores</p>
        </div>

        <a type="btn" class="sub-btn-w btn my-custom-btn" href="{{ route('usuario.create') }}">Añadir Usuario</a>
    </div>

    <div class="d-flex justify-content-center"> <!-- Para centrar el contenido -->
        <table class="table table-striped table-hover table-bordered w-90 mx-auto" style="margin-top: 15pt">
            <thead class="table-dark">
                <tr>
                    <th class="col-3 text-center">Nombre</th>
                    <th class="col-3 text-center">Correo</th>
                    <th class="col-md-3 text-center">Nivel</th>
                    <th class="col-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td data-label="Nombre" class="text-center"><strong>{{ $usuario->name }}</strong></td>
                        <td data-label="Correo" class="text-center"><strong>{{ $usuario->email }}</strong></td>
                        <td data-label="Nivel" class="text-center col-md-3">
                            @foreach ($usuario->permisos as $permiso)
                                <span>{{ $permiso->tipo_permiso }}</span><br>
                            @endforeach
                        </td>
                        <td data-label="Acciones">
                            <div class="d-none d-md-flex justify-content-around"> <!-- Botones visibles en pantallas medianas y grandes -->
                                <a class="btn my-custom-btn flex-grow-1 mx-1"
                                    href="{{ route('usuario.show', $usuario->id) }}">Mostrar</a>
                        
                                <a class="btn btn-success flex-grow-1 mx-1"
                                    href="{{ route('usuario.edit', $usuario->id) }}">Modificar</a>
                        
                                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="flex-grow-1 mx-1">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger w-100" type="submit">Eliminar</button>
                                </form>
                            </div>
                        
                            <div class="dropdown d-md-none"> <!-- Dropdown visible solo en pantallas pequeñas -->
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $usuario->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $usuario->id }}">
                                    <li><a class="dropdown-item" href="{{ route('usuario.show', $usuario->id) }}" onclick="markSelected(this)">Mostrar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('usuario.edit', $usuario->id) }}" onclick="markSelected(this)">Modificar</a></li>
                                    <li>
                                        <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit" onclick="markSelected(this)">Eliminar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        
                        <script>
                            function markSelected(element) {
                                // Remover la clase 'selected' de todos los elementos
                                const items = document.querySelectorAll('.dropdown-item');
                                items.forEach(item => {
                                    item.classList.remove('selected');
                                });
                        
                                // Agregar la clase 'selected' al elemento seleccionado
                                element.classList.add('selected');
                            }
                        </script>
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $usuarios->links('vendor.pagination.bootstrap-4') }}

    <!-- Incluir JS de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
@endsection
