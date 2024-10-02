@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <!-- Ajustes para la responsividad de la pagina-->
        <div class="col-12 col-md-8 col-lg-6"> <!-- Ajusta el tamaño dependiendo del dispositivo -->
            <h1 class="text-center mb-4">Registrar Permiso</h1>

            <form action="{{ route('permiso.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="tipo_permiso" class="form-label">Nombre del permiso:</label>
                    <input type="text" id="tipo_permiso" name="tipo_permiso" class="form-control">
                    @error('tipo_permiso')
                        <div class="alert alert-danger">Debe escribirse un nombre</div>
                    @enderror
                </div>

                <!-- Ajustes para la responsividad de la pagina-->
                <!-- Envolver el botón en un div con el mismo ancho que el input -->
                <div class="mb-3">
                    <button class="btn btn-primary w-100" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
