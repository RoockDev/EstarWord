<?php

use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;
use App\Http\Controllers\MantenimientoController;
use App\Models\Nave;
use App\Models\Piloto;
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
/**Endpoints naves */
Route::get('/naves', [NaveController::class, 'index']);
Route::get('/naves/{nave}', [NaveController::class, 'show']);
Route::post('/naves',[NaveController::class, 'store']);
Route::put('/naves/{nave}', [NaveController::class,'update']);
Route::delete('/naves/{nave}', [NaveController::class, 'destroy']);
Route::post('/naves/asignarPiloto/{nave}', [NaveController::class, 'asignarPiloto']);
Route::put('/naves/desasignarPiloto/{nave}',[NaveController::class,'desasignarPiloto']);
Route::get('/navesSinPiloto/',[NaveController::class,'navesSinPiloto']);
/**Endpoints pilotos */
Route::get('/historicoPilotosAsignados', [PilotoController::class, 'listarHistoricoPilotosAsignados']);
Route::get('/pilotosAsignadosActualmente',[PilotoController::class, 'pilotosAsignadosActualmente']);
/**Endpoints mantenimientos */
Route::post('/naves/{nave}/mantenimientos ',[MantenimientoController::class, 'store']);
Route::get('/mantenimientos/{mantenimiento}', [MantenimientoController::class, 'show']);

