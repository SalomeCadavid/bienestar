<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::with('tipoProducto')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'tipo_producto_id' => 'required|exists:tipo_producto,id'
        ]);

<<<<<<< HEAD
        $producto = Producto::create($request->all());

        return response()->json([
            'message' => 'Producto creado correctamente',
            'data' => $producto
        ], 201);
=======
        $ruta = null;

        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $ruta,
            'precio' => $request->precio,
            'categoria' => $request->categoria,
            'stock' => $request->stock,
            'tipo_producto_id' => $request->tipo_producto_id,
        ]);

        return response()->json($producto);
>>>>>>> b6b4d5e451b129a80554eeeddc511c1691b2a088
    }

    public function show($id)
    {
        return Producto::with('tipoProducto')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:100',
            'precio' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'tipo_producto_id' => 'sometimes|exists:tipo_producto,id'
        ]);

<<<<<<< HEAD
        $producto->update($request->all());

=======
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $ruta;
        }

        $producto->update($request->except('imagen'));

>>>>>>> b6b4d5e451b129a80554eeeddc511c1691b2a088
        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'data' => $producto
        ]);
    }

<<<<<<< HEAD
public function destroy($id)
{
    try {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json([
            "message" => "Producto eliminado"
        ]);

    } catch (\Illuminate\Database\QueryException $e) {

        return response()->json([
            "error" => "No se puede eliminar el producto porque tiene ventas registradas"
        ], 400);

    }
}
=======
    public function destroy($id)
    {
        Producto::destroy($id);

        return response()->json([
            'mensaje' => 'Producto eliminado'
        ]);
    }
>>>>>>> b6b4d5e451b129a80554eeeddc511c1691b2a088
}