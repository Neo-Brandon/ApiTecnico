@extends('layouts.app')

@section('content')
    <style>
        .titulo-perm{
            margin-left: 120pt
        }
    </style>

    <div class="container-xxl">
        <div class="text-center">
            <div class="titulo">
                <h1>Permisos</h1>
            </div>

            <a type="btn" class="sub-btn-w btn my-custom-btn" style="margin-top: 15pt; margin-left:15pt"
                href="{{ route('permiso.create') }}">Añadir Permiso</a>
        </div>
        <div class="d-flex justify-content-center"> <!-- Para centrar el contenido -->
            <table class="table table-striped table-hover table-bordered w-75 mx-auto" style="margin-top: 15pt">
                <thead class="table-secondary">
                    <tr>
                        <th class="col-3 text-center">Tipo de permiso</th>
                        <th class="col-3 text-center">Acciones</th>
                    </tr>
                </thead>
                @foreach ($permisos as $permiso)
                    <tr>
                        <td class="text-center">{{ $permiso->tipo_permiso }}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a class="btn my-custom-btn flex-grow-1 mx-1"
                                    href="{{ route('permiso.show', $permiso->id) }}">Mostrar</a>

                                <a class="btn btn-success flex-grow-1 mx-1"
                                    href="{{ route('permiso.edit', $permiso->id) }}">Modificar</a>

                                <form action="{{ route('permiso.destroy', $permiso->id) }}" method="POST" class="flex-grow-1 mx-1">
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
        {{ $permisos->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
