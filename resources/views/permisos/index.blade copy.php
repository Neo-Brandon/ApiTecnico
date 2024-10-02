@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        <div class="titulo">
            <h1>Permisos</h1>
        </div>

        <a type="btn" class="sub-btn-w btn btn-primary" style="margin-top: 15pt; margin-left:15pt"
            href="{{ route('permiso.create') }}">Añadir Permiso</a>

        <div>

            <table class="table table-striped table-hover table-bordered" style="margin-top: 15pt">
                <thead class="table-dark">
                    <tr>
                        <th class="col-1 text-center">ID</th>
                        <th class="col-3">Tipo_permiso</th>
                    </tr>
                </thead>
                @foreach ($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->tipo_permiso }}</td>
                        <td>
                            <form action="{{ route('permiso.destroy', $permiso->id) }}" method="POST">

                                <a type="btn" class="btn btn-primary"
                                    href="{{ route('permiso.show', $permiso->id) }}">Mostrar</a>

                                <a type="btn" class="marg-crud btn btn-success"
                                    href="{{ route('permiso.edit', $permiso->id) }}">Modificar</a>

                                @csrf
                                @method('DELETE') <!-- ESTBLECEMOS AQUI EL METODO DELETE-->
                                <button type="btn" class="marg-crud btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $permisos->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
@endsection
