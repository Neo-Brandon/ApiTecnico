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
                <h1>tareas</h1>
            </div>
-->
<div class="container-xxl d-flex flex-column justify-content-center align-items-center" >
    <div class="welcome text-center">
        <h2><strong>Tareas</strong></h2>
        <p>Registre nuevas tareas para los técnicos</p>
    </div>

    <a type="btn" class="sub-btn-w btn my-custom-btn" href="{{ route('tarea.create') }}">Añadir Tarea</a>
</div>

        <div class="d-flex justify-content-center"> <!-- Para centrar el contenido -->
            <table class="table table-striped table-hover table-bordered w-90 mx-auto" style="margin-top: 15pt">
                <thead class="table-dark">
                    <tr>
                        <th class="col-3 text-center">Titulo</th>
                        <!-- <th class="col-4 text-center">Descripcion</th> -->
                        <th class="col-md-3 text-center">Categoría</th>
                        <th class="col-md-3 text-center">Tecnicos</th>
                        <th class="col-md-6 text-center">Estado Tarea</th>
                        <th class="col-3 text-center">Acciones</th>
                    </tr>
                </thead>
                @foreach ($tareas as $tarea)
                    <tr>
                        <td class="text-center"><strong>{{ $tarea->titulo }}</strong></td>
                       <!--  <td class="text-center">{{ $tarea->descripcion }}</td> -->
                        <td class="text-center col-md-3">
                            {{ $tarea->categoria->categoria ?? 'Sin categoría' }}
                        </td>
                        <td class="text-center col-md-3">
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
                        <td class="text-center col-md-3">
                            {{ $tarea->estado->nombre_estado ?? 'Sin categoría' }}
                        </td>
                        <td>
                            <div class="d-flex justify-content-around">
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
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $tareas->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
