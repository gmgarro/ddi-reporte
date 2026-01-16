<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClienteController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\EquipoController;
use App\Http\Controllers\Api\TipoEquipoController;
use App\Http\Controllers\Api\TareaController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json($request->user());
});

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Sesión cerrada'
    ]);
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::get('/tareas/hoy', [TareaController::class, 'hoy']);

     Route::get('/equipos', [EquipoController::class, 'index']);
    Route::post('/equipos', [EquipoController::class, 'store']);
    Route::put('/equipos/{equipo}', [EquipoController::class, 'update']);
    Route::delete('/equipos/{equipo}', [EquipoController::class, 'destroy']);

    // Tipos
    Route::post('/tipo-equipos', [TipoEquipoController::class, 'store']);
    Route::delete('/tipo-equipos/{tipoEquipo}', [TipoEquipoController::class, 'destroy']);

});