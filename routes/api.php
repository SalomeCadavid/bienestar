<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecomendacionSemanalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacturaController;

/*
|--------------------------------------------------------------------------
| RUTAS PUBLICAS
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// PRODUCTOS PUBLICOS
Route::get('/productos', [ProductoController::class,'index']);
Route::get('/productos/{id}', [ProductoController::class,'show']);

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CALCULAR IMC
    |--------------------------------------------------------------------------
    */

    Route::post('/usuarios/calcular-imc', [UsuarioController::class, 'calcularImc']);
    /*
    |--------------------------------------------------------------------------
    | USUARIO AUTENTICADO
    |--------------------------------------------------------------------------
    */

    Route::get('/user', function (Request $request) {
        return $request->user()->load('role');
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR PERFIL
    |--------------------------------------------------------------------------
    */

    Route::put('/perfil', function (Request $request) {

        $request->validate([
            'genero' => 'nullable|string|max:10',
            'edad' => 'nullable|integer|min:1|max:120',
            'peso' => 'nullable|numeric|min:1',
            'estatura' => 'nullable|numeric|min:1'
        ]);

        $user = $request->user();

        $imc = null;

        if ($request->peso && $request->estatura) {

            $alturaMetros = $request->estatura / 100;

            $imc = round(
                $request->peso / ($alturaMetros * $alturaMetros),
                2
            );
        }

        $user->update([
            'genero' => $request->genero,
            'edad' => $request->edad,
            'peso' => $request->peso,
            'estatura' => $request->estatura,
            'imc' => $imc
        ]);

        return response()->json([
            "message" => "Perfil actualizado correctamente",
            "data" => $user->load('role')
        ]);
    });

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

        Route::apiResource('facturas', FacturaController::class)
            ->only(['index','store','show']);

    });

});