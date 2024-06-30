<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\MantenimientoHasEquipoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signUp']);
    
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);

        Route::apiResource('ambientes', AmbienteController::class);
        Route::apiResource('categorias', CategoriaController::class);
        Route::apiResource('clases', ClaseController::class);
        Route::apiResource('equipos', EquipoController::class);
        Route::apiResource('mantenimientos', MantenimientoController::class);
        Route::apiResource('categorias', MantenimientoHasEquipoController::class);

    });
});
