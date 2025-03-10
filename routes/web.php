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
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;


// Rutas de pruebas ---------------------------------------------------------------------
Route::get('/check-role', [TestController::class, 'checkRole']);

// Fin Rutas de pruebas ---------------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/dashboard', function () {
    return view('/admin/index');
})->middleware(['auth', 'verified'])->name('dashboard');
*/


Route::get('/dashboard', function () {
    $user = Auth::user();

    // Por alguna razon desconocida Mi version de Inteliphense me marca
    // Como error la funcion hasRole(), es un falso error ya que funciona
    if ($user->hasRole('Administrador')) {
        return view('admin.index');
    } elseif ($user->hasRole('Tecnico')) {
        return view('tecnico.index');
    } else {
        return redirect('/'); // O cualquier otra ruta de redirección por defecto
    }
})->middleware(['auth', 'verified', 'role:Administrador,Tecnico'])->name('dashboard');


// Ruta aun por confirmar, no hay nada establecido en el perfil, por ahora
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Rutas inactivas debido a la nula necesidad de registros masivos
//Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
//Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');


require __DIR__.'/auth.php';

// Administrador -----------------------------------------------------------------------------------

/*
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('/admin/index');
    });
});
*/


Route::middleware(['auth', 'verified', 'role:Administrador'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    // Otras rutas exclusivas para administradores...
    Route::get('/admin', function () {
        return view('/admin/index');
    });
});

//Ruta para el menu "añadir" del administrador
Route::get('/admin/añadir', function () {
    return view('/admin/añadir');
});

// Tecnico -----------------------------------------------------------------------------------

// Rutas protegidas para el usuario tecnico
Route::middleware(['auth', 'verified', 'role:Tecnico'])->group(function () {
    Route::get('/tecnico/dashboard', function () {
        return view('tecnico.index');
    })->name('tecnico.dashboard');

    // Otras rutas exclusivas para Tecnicos...
    
    Route::get('/tecnico', function () {
        return view('/tecnico/index');
    });
    
});



//Route::middleware('auth:api')->get('/user-tasks', [TareaController::class, 'loadTasks']);

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
Route::get('/mis-tareas', [TareaController::class, 'misTareas'])->name('tarea.misTareas');

Route:: get('/tareas', [TareaController::class, 'index'])-> name('tarea.index');
Route:: get('/tareas/create', [TareaController::class, 'create'])->name('tarea.create');
Route:: get('/tareas/{id}', [TareaController::class, 'show'])->name('tarea.show');
Route:: post('/tareas', [TareaController::class, 'store'])->name('tarea.store');
Route:: delete('/tareas/delete/{id}', [TareaController::class, 'destroy'])->name('tarea.destroy');
Route:: get('/tareas/edit/{id}', [TareaController::class, 'edit'])-> name('tarea.edit');
Route:: put('/tareas/update/{id}', [TareaController::class, 'update'])-> name('tarea.update');