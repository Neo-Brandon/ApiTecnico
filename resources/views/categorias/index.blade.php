@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <style>
        .titulo-perm{
            margin-left: 120pt
        }
    </style>

        <div class="container-xxl d-flex flex-column justify-content-center align-items-center" >
            <div class="welcome text-center">
                <h2><strong>Categorias</strong></h2>
                <p>Registre categorias o revise las existentes</p>
            </div>
            <a type="btn" class="sub-btn-w btn my-custom-btn" href="{{ route('categoria.create') }}">Añadir Categoría</a>
        </div>

        <div class="d-flex justify-content-center"> <!-- Para centrar el contenido -->
            <table class="table table-striped table-hover table-bordered w-90 mx-auto" style="margin-top: 15pt">
                <thead class="table-dark">
                    <tr>
                        <th class="col-3 text-center">Nombres de categorias</th>
                        <th class="col-3 text-center">Acciones</th>
                    </tr>
                </thead>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td class="text-center"><strong>{{ $categoria->categoria }}</strong></td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a class="btn my-custom-btn flex-grow-1 mx-1"
                                    href="{{ route('categoria.show', $categoria->id) }}">Mostrar</a>

                                <a class="btn btn-success flex-grow-1 mx-1"
                                    href="{{ route('categoria.edit', $categoria->id) }}">Modificar</a>

                                <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST" class="flex-grow-1 mx-1">
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
        {{ $categorias->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
