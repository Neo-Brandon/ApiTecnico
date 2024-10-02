<?php

use App\Models\Permiso;
use App\Http\Controllers\permisoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Rutas Permisos -------------------------------------------------------------------------------------------

Route:: get('/permisos', [PermisoController::class, 'index'])-> name('permiso.index');
Route:: get('/permisos/create', [permisoController::class, 'create'])->name('permiso.create');
Route:: get('/permisos/{id}', [permisoController::class, 'show'])->name('permiso.show');
Route:: post('/permisos', [permisoController::class, 'store'])->name('permiso.store');
Route:: delete('/permisos/delete/{id}', [permisoController::class, 'destroy'])->name('permiso.destroy');
Route:: get('/permisos/edit/{id}', [permisoController::class, 'edit'])-> name('permiso.edit');
Route:: put('/permisos/update/{id}', [permisoController::class, 'update'])-> name('permiso.update');

// Rutas Categorias -------------------------------------------------------------------------------------------

Route:: get('/categorias', [CategoriaController::class, 'index'])-> name('categoria.index');
Route:: get('/categorias/create', [CategoriaController::class, 'create'])->name('categoria.create');
Route:: get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categoria.show');
Route:: post('/categorias', [CategoriaController::class, 'store'])->name('categoria.store');
Route:: delete('/categorias/delete/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
Route:: get('/categorias/edit/{id}', [CategoriaController::class, 'edit'])-> name('categoria.edit');
Route:: put('/categorias/update/{id}', [CategoriaController::class, 'update'])-> name('categoria.update');

// Rutas Usuarios -------------------------------------------------------------------------------------------

Route:: get('/usuarios', [UsuarioController::class, 'index'])-> name('usuario.index');
Route:: get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route:: get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuario.show');
Route:: post('/usuarios', [UsuarioController::class, 'store'])->name('usuario.store');
Route:: delete('/usuarios/delete/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route:: get('/usuarios/edit/{id}', [UsuarioController::class, 'edit'])-> name('usuario.edit');
Route:: put('/usuarios/update/{id}', [UsuarioController::class, 'update'])-> name('usuario.update');