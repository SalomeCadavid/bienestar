<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecomendacionSemanalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\OrdenController;

/*
|--------------------------------------------------------------------------
| RUTAS PUBLICAS
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/usuarios/calcular-imc', [UsuarioController::class, 'calcularImc']);

// 🔥 PRODUCTOS PUBLICOS (IMPORTANTE)
Route::get('/productos', [ProductoController::class,'index']);
Route::get('/productos/{id}', [ProductoController::class,'show']);

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | SOLO ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::apiResource('usuarios', UsuarioController::class);
        Route::apiResource('tipo-productos', TipoProductoController::class);

        Route::post('/productos', [ProductoController::class,'store']);
        Route::put('/productos/{id}', [ProductoController::class,'update']);
        Route::delete('/productos/{id}', [ProductoController::class,'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | CLIENTE Y ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:cliente,admin')->group(function () {

        Route::apiResource('recomendaciones', RecomendacionSemanalController::class);
        Route::apiResource('facturas', FacturaController::class)->only(['index','store','show']);
    });

});