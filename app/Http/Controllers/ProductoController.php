<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::with('tipoProducto')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:100',
            'precio'           => 'required|numeric',
            'stock'            => 'required|integer',
            'tipo_producto_id' => 'required|exists:tipo_producto,id',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $datos = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create($datos);

        return response()->json([
            'message' => 'Producto creado correctamente',
            'data'    => $producto
        ], 201);
    }

    public function show($id)
    {
        return Producto::with('tipoProducto')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre'           => 'sometimes|string|max:100',
            'precio'           => 'sometimes|numeric',
            'stock'            => 'sometimes|integer',
            'tipo_producto_id' => 'sometimes|exists:tipo_producto,id',
            'imagen'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $datos = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            // Elimina la imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'data'    => $producto
        ]);
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);

            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $producto->delete();

            return response()->json([
                'message' => 'Producto eliminado'
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'No se puede eliminar el producto porque tiene ventas registradas'
            ], 400);
        }
    }
}