<?php

use App\Http\Controllers\NaveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * convencion en desarrollo web
 * index: mostrar lista de todos los recursos
 * show: mostrar un solo recurso
 * store: para guardar un nuevo recurso
 * update: para actualizar un recurso existente
 * destroy: para eliminar un recurso
 */
Route::get('/naves', [NaveController::class, 'index']);
Route::get('/naves/{nave}', [NaveController::class, 'show']);
Route::post('/naves',[NaveController::class, 'store']);
Route::put('/naves', [NaveController::class],'update');
Route::delete('/naves/{nave}', [NaveController::class, 'destroy']);

