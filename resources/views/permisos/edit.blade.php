@extends('layouts.app')

@section('content')
    <div class="container"> <!-- Uso de 'container' para mayor control de layout -->
        <h1 class="text-center mb-4">Editar Permiso</h1>

        <form action="{{ route('permiso.update', $permiso->id) }}" method="post">
            @csrf
            @method('PUT') <!-- Usa el método correcto para la actualización -->

            <div class="row g-3">
                <div class="col-12 col-sm-6 mx-auto"> <!-- Ocupa toda la pantalla en móviles y 6 columnas en pantallas más grandes -->
                    <label for="tipo_permiso" class="form-label">Nombre del permiso:</label>
                    <input type="text" id="tipo_permiso" name="tipo_permiso" class="form-control"
                           value="{{ $permiso->tipo_permiso }}">
                    @error('tipo_permiso')
                        <div class="alert alert-danger">Debe escribirse un nombre</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-12 col-sm-6 mx-auto"> <!-- Botón también centrado y adaptado a pantallas pequeñas -->
                    <button class="btn btn-primary w-100" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
