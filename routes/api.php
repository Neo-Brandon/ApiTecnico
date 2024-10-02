<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\permisoApiController;
use App\Http\Controllers\usuarioApiController;
use App\Http\Controllers\categoriaApiController;
use App\Http\Controllers\tareaApiController;
use App\Http\Controllers\NotaApiController;

Route::get('/permisos', [permisoApiController::class, 'index']);
Route::get('/permisos/{id}', [permisoApiController::class, 'show']);
Route::post('/permisos', [permisoApiController::class, 'store']);
Route::put('/permisos/{id}', [permisoApiController::class, 'update']);
Route::delete('/permisos/{id}', [permisoApiController::class, 'destroy']);

//------------------------------------------------------------------------

Route::get('/usuarios', [usuarioApiController::class, 'index']);
Route::get('/usuarios/{id}', [usuarioApiController::class, 'show']);
Route::post('/usuarios', [usuarioApiController::class, 'store']);
Route::put('/usuarios/{id}', [usuarioApiController::class, 'update']);
Route::delete('/usuarios/{id}', [usuarioApiController::class, 'destroy']);

//------------------------------------------------------------------------

Route::get('/categorias', [categoriaApiController::class, 'index']);
Route::get('/categorias/{id}', [categoriaApiController::class, 'show']);
Route::post('/categorias', [categoriaApiController::class, 'store']);
Route::put('/categorias/{id}', [categoriaApiController::class, 'update']);
Route::delete('/categorias/{id}', [categoriaApiController::class, 'destroy']);

//------------------------------------------------------------------------

Route::get('/tareas', [tareaApiController::class, 'index']);
Route::get('/tareas/{id}', [tareaApiController::class, 'show']);
Route::post('/tareas', [tareaApiController::class, 'store']);
Route::put('/tareas/{id}', [tareaApiController::class, 'update']);
Route::delete('/tareas/{id}', [tareaApiController::class, 'destroy']);

//------------------------------------------------------------------------

Route::get('/notas', [NotaApiController::class, 'index']);
Route::get('/notas/{id}', [NotaApiController::class, 'show']);
Route::post('/notas', [NotaApiController::class, 'store']);
Route::put('/notas/{id}', [NotaApiController::class, 'update']);
Route::delete('/notas/{id}', [NotaApiController::class, 'destroy']);

Route::get('notas/tarea/{id}', [NotaApiController::class, 'getNotasByTarea']);
