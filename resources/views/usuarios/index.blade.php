@extends('layouts.app')

@section('content')
    <style>
        .titulo-perm{
            margin-left: 120pt
        }

    </style>

<!--
    <div class="container-xxl">
        <div class="text-center">
            <div class="titulo">
                <h1>Usuarios</h1>
            </div>
-->
    <div class="container-xxl d-flex flex-column justify-content-center align-items-center" >
        <div class="welcome text-center">
            <h2><strong>Usuarios</strong></h2>
            <p>Registre nuevos tecnicos o administradores</p>
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
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td class="text-center"><strong>{{ $usuario->nombre }}</strong></td>
                        <td class="text-center"><strong>{{ $usuario->correo }}</strong></td>
                        <td class="text-center col-md-3">
                            @foreach ($usuario->permisos as $permiso)
                                <span>{{ $permiso->tipo_permiso }}</span><br>
                            @endforeach
                        </td>
                        <td>
                            <div class="d-flex justify-content-around">
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
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $usuarios->links('vendor.pagination.bootstrap-4') }}
    </div>
    <!-- Incluir JS de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
@endsection
