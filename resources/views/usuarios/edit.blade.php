@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

        <div class="container-xxl d-flex flex-column justify-content-center align-items-center" >
            <div class="welcome text-center">
                <h2><strong>Edite el usuario</strong></h2>
                <p>Edite nombre, permisos u otro parámetro</p>
            </div>
        </div>

        <form action="{{ route('usuario.update', $usuario->id) }}" method="post">
            @csrf
            @method('PUT') <!-- Usa el método correcto para la actualización -->

            <div class="row g-3">
                <div class="col-12 col-sm-6 mx-auto"> <!-- Ocupa toda la pantalla en móviles y 6 columnas en pantallas más grandes -->
                    <label for="nombre" class="form-label">Nombre del usuario:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control my-custom-input"
                           value="{{ $usuario->nombre }}">
                    @error('nombre')
                        <div class="alert alert-danger">Debe escribirse un nombre</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-sm-6 mx-auto"> <!-- Ocupa toda la pantalla en móviles y 6 columnas en pantallas más grandes -->
                    <label for="correo" class="form-label">Correo del usuario:</label>
                    <input type="text" id="correo" name="correo" class="form-control my-custom-input"
                           value="{{ $usuario->correo }}">
                    @error('correo')
                        <div class="alert alert-danger">Debe escribirse un correo</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-sm-6 mx-auto"> <!-- Ocupa toda la pantalla en móviles y 6 columnas en pantallas más grandes -->
                    <label for="pass" class="form-label">Contraseña del usuario (Restablecer):</label>
                    <input type="text" id="pass" name="pass" class="form-control my-custom-input"
                           value="">
                    @error('pass')
                        <div class="alert alert-danger">Debe escribirse una contraseña</div>
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
