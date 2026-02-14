<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Detalle_Factura;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function index(Request $request)
    {
        return Factura::with('detalles.producto')
            ->where('usuario_id', $request->user()->id)
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);

        return DB::transaction(function () use ($request) {

            $total = 0;

            // Crear factura
            $factura = Factura::create([
                'usuario_id' => $request->user()->id,
                'total' => 0,
                'fecha' => now()
            ]);

            foreach ($request->productos as $item) {

                $producto = Producto::findOrFail($item['producto_id']);

                // Verificar stock
                if ($producto->stock < $item['cantidad']) {
                    abort(400, "Stock insuficiente para {$producto->nombre}");
                }

                $subtotal = $producto->precio * $item['cantidad'];
                $total += $subtotal;

                // Crear detalle
                Detalle_Factura::create([
                    'factura_id' => $factura->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio
                ]);

                // Descontar stock
                $producto->decrement('stock', $item['cantidad']);
            }

            // Actualizar total
            $factura->update(['total' => $total]);

            return response()->json([
                'message' => 'Factura creada correctamente',
                'factura' => $factura->load('detalles.producto')
            ], 201);
        });
    }

    public function show($id, Request $request)
    {
        return Factura::with('detalles.producto')
            ->where('usuario_id', $request->user()->id)
            ->findOrFail($id);
    }
}
