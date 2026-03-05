<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrdenController extends Controller
{
    public function crearOrden(Request $request)
    {
        $usuario = $request->user();

        $producto = Producto::findOrFail($request->producto_id);

        // Solo permitir planes
        if ($producto->tipo_producto_id != 1) {
            return response()->json([
                'error' => 'Este producto no es un plan'
            ], 400);
        }

        $orden = Orden::create([
            'usuario_id' => $usuario->id,
            'producto_id' => $producto->id,
            'referencia_pago' => 'ORD-' . strtoupper(Str::random(10)),
            'monto' => $producto->precio,
            'estado' => 'pendiente'
        ]);

        return response()->json([
            'message' => 'Orden creada correctamente',
            'orden' => $orden
        ]);
    }
}