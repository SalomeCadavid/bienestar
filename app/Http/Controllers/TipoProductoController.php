<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    public function index()
    {
        return TipoProducto::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50'
        ]);

        return TipoProducto::create($request->all());
    }

    public function show($id)
    {
        return TipoProducto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoProducto::findOrFail($id);
        $tipo->update($request->all());

        return $tipo;
    }

    public function destroy($id)
    {
        TipoProducto::destroy($id);
        return response()->json(['mensaje' => 'Tipo eliminado']);
    }
}
