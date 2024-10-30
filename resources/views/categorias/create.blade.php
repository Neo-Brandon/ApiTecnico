@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<div class=" container-xxl d-flex justify-content-center">
    <!-- Ajustes para la responsividad de la pagina-->
    <div class="col-12 col-md-8 col-lg-6"> <!-- Ajusta el tamaño dependiendo del dispositivo -->
        <div class="welcome text-center">
            <h2><strong>Registrar categoría</strong></h2>
        </div>

            <form action="{{ route('categoria.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="categoria" class="form-label">Nombre de la categoría:</label>
                    <input type="text" id="categoria" name="categoria" class="form-control">
                    @error('categoria')
                        <div class="alert alert-danger">Debe escribirse un nombre</div>
                    @enderror
                </div>

                <!-- Ajustes para la responsividad de la pagina-->
                <!-- Envolver el botón en un div con el mismo ancho que el input -->
                <div class="mb-3">
                    <button class="btn btn-primary w-100 my-custom-btn" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
