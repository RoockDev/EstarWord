<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\UserController;
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




Route::middleware('auth:sanctum')->group(function () {
        /**Endpoints naves */
    /* disponibles para todos*/
    Route::get('/naves', [NaveController::class, 'index'])->middleware('midnavelistar');
    Route::get('/naves/{nave}', [NaveController::class, 'show'])->middleware('midnavelistar');
    Route::get('/navesSinPiloto/', [NaveController::class, 'navesSinPiloto'])->middleware('midnavelistar');
    /**Solo accesible para admin */
    Route::post('/naves', [NaveController::class, 'store'])->middleware('midadmin');
    Route::put('/naves/{nave}', [NaveController::class, 'update'])->middleware('midadmin');
    Route::delete('/naves/{nave}', [NaveController::class, 'destroy'])->middleware('midadmin');
    Route::put('users/{user}/role', [UserController::class, 'updateRole'])->middleware('midadmin');


    /**Accesible para el gestor */
    Route::post('/naves/asignarPiloto/{nave}', [NaveController::class, 'asignarPiloto'])->middleware('midpilotoasignar');
    Route::put('/naves/desasignarPiloto/{nave}', [NaveController::class, 'desasignarPiloto'])->middleware('midpilotodesasignar');
    
    /**Endpoints pilotos */
    /**disponibles para todos */
    Route::get('/historicoPilotosAsignados', [PilotoController::class, 'listarHistoricoPilotosAsignados'])->middleware('midpilotolistar');
    Route::get('/pilotosAsignadosActualmente', [PilotoController::class, 'pilotosAsignadosActualmente'])->middleware('midpilotolistar');
    /**Endpoints mantenimientos */
    Route::post('/naves/{nave}/mantenimientos ', [MantenimientoController::class, 'store'])->middleware('midmantenimientocrear');
    Route::get('/mantenimientos/{mantenimiento}', [MantenimientoController::class, 'show'])->middleware('midmantenimientolistar');
    Route::get('/mantenimientos/{inicio?}/{fin?}', [MantenimientoController::class, 'mantenimientosEntreFechas'])->middleware('midmantenimientolistar'); 
});


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);

Route::get('/nologin', function () {
    return response()->json(["success"=>false, "message" => "Unauthorised"],203);
});

// Route::middleware('auth:sanctum')->group(function () {
//         /**Endpoints naves */
//     /* disponibles para todos*/
//     Route::get('/naves', [NaveController::class, 'index'])->middleware('ability:nave:listar');
//     Route::get('/naves/{nave}', [NaveController::class, 'show'])->middleware('ability:nave:listar');
//     Route::get('/navesSinPiloto/', [NaveController::class, 'navesSinPiloto']);
//     /**Solo accesible para admin */
//     Route::post('/naves', [NaveController::class, 'store'])->middleware('ability:*');
//     Route::put('/naves/{nave}', [NaveController::class, 'update'])->middleware('ability:*');
//     Route::delete('/naves/{nave}', [NaveController::class, 'destroy'])->middleware('ability:*');
//     Route::put('users/{user}/role', [UserController::class, 'update_role'])->middleware('ability:*');


//     /**Accesible para el gestor */
//     Route::post('/naves/asignarPiloto/{nave}', [NaveController::class, 'asignarPiloto'])->middleware('ability:piloto:asignar');
//     Route::put('/naves/desasignarPiloto/{nave}', [NaveController::class, 'desasignarPiloto'])->middleware('ability:piloto:desasignar');
    
//     /**Endpoints pilotos */
//     /**disponibles para todos */
//     Route::get('/historicoPilotosAsignados', [PilotoController::class, 'listarHistoricoPilotosAsignados'])->middleware('ability:piloto:listar');
//     Route::get('/pilotosAsignadosActualmente', [PilotoController::class, 'pilotosAsignadosActualmente'])->middleware('ability:piloto:listar');
//     /**Endpoints mantenimientos */
//     Route::post('/naves/{nave}/mantenimientos ', [MantenimientoController::class, 'store'])->middleware('ability: mantenimiento:crear');
//     Route::get('/mantenimientos/{mantenimiento}', [MantenimientoController::class, 'show'])->middleware('ability: mantenimiento:listar');
//     Route::get('/mantenimientos/{inicio?}/{fin?}', [MantenimientoController::class, 'mantenimientosEntreFechas'])->middleware('ability:mantenimiento:listar'); 
// });


// Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', [AuthController::class, 'logout']);
// Route::post('register', [AuthController::class, 'register']);

// Route::get('/nologin', function () {
//     return response()->json(["success"=>false, "message" => "Unauthorised"],203);
// });
