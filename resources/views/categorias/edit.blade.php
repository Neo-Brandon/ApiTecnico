@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <div class="container-xxl d-flex flex-column justify-content-center align-items-center" >
        <div class="welcome text-center">
            <h2><strong>Categorias</strong></h2>
            <p>Registre categorias</p>
        </div>
    </div>
        <form action="{{ route('categoria.update', $categoria->id) }}" method="post">
            @csrf
            @method('PUT') <!-- Usa el método correcto para la actualización -->

            <div class="row g-3">
                <div class="col-12 col-sm-6 mx-auto"> <!-- Ocupa toda la pantalla en móviles y 6 columnas en pantallas más grandes -->
                    <label for="categoria" class="form-label">Nombre de la categoría:</label>
                    <input type="text" id="categoria" name="categoria" class="form-control my-custom-input  "
                           value="{{ $categoria->categoria }}">
                    @error('categoria')
                        <div class="alert alert-danger">Debe escribirse un nombre</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-12 col-sm-6 mx-auto"> <!-- Botón también centrado y adaptado a pantallas pequeñas -->
                    <button class="btn my-custom-btn w-100" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
