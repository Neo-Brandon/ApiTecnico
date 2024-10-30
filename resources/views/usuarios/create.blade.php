@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="container-xxl d-flex justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="welcome text-center">
            <h2><strong>Registrar usuario</strong></h2>
            <p>Registre nuevos técnicos o administradores</p>
        </div>
        <form action="{{ route('usuario.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre usuario:</label>
                <input type="text" id="name" name="name" class="form-control my-custom-input">
                @error('name')
                <div class="alert alert-danger">Debe escribirse un nombre</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" id="email" name="email" class="form-control my-custom-input">
                @error('email')
                <div class="alert alert-danger">Debe escribirse un email</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control my-custom-input">
                @error('password')
                <div class="alert alert-danger">Debe escribirse una contraseña</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="col-sm-6">
                    <label for="role_id" class="form-label">Tipo de usuario:</label>
                    <select class="form-select" id="role_id" name="role_id">
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary my-custom-btn w-100" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
