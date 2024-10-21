<?php

use App\Models\Permiso;
use App\Http\Controllers\permisoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
//Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');


require __DIR__.'/auth.php';

// Administrador -----------------------------------------------------------------------------------
//Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('/admin/index');
    });
//});

Route::get('/admin/añadir', function () {
    return view('/admin/añadir');
});

// Tecnico -----------------------------------------------------------------------------------
Route::get('/tecnico', function () {
    return view('/tecnico/index');
});

// Crear informes - Tecnico
Route:: get('/informes', [InformeController::class, 'index'])-> name('informe.index');
Route:: get('/informes/create', [InformeController::class, 'create'])->name('informe.create');
Route:: get('/informes/{id}', [InformeController::class, 'show'])->name('informe.show');
Route:: post('/informes', [InformeController::class, 'store'])->name('informe.store');
Route:: delete('/informes/delete/{id}', [InformeController::class, 'destroy'])->name('informe.destroy');
Route:: get('/informes/edit/{id}', [InformeController::class, 'edit'])-> name('informe.edit');
Route:: put('/informes/update/{id}', [InformeController::class, 'update'])-> name('informe.update');


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

// Rutas Usuarios -------------------------------------------------------------------------------------------

Route:: get('/tareas', [TareaController::class, 'index'])-> name('tarea.index');
Route:: get('/tareas/create', [TareaController::class, 'create'])->name('tarea.create');
Route:: get('/tareas/{id}', [TareaController::class, 'show'])->name('tarea.show');
Route:: post('/tareas', [TareaController::class, 'store'])->name('tarea.store');
Route:: delete('/tareas/delete/{id}', [TareaController::class, 'destroy'])->name('tarea.destroy');
Route:: get('/tareas/edit/{id}', [TareaController::class, 'edit'])-> name('tarea.edit');
Route:: put('/tareas/update/{id}', [TareaController::class, 'update'])-> name('tarea.update');