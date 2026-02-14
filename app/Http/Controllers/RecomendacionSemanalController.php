<?php

namespace App\Http\Controllers;

use App\Models\Recomendaciones_Semanales;
use App\Models\RecomendacionSemanal;
use Illuminate\Http\Request;

class RecomendacionSemanalController extends Controller
{
    public function index()
    {
        return Recomendaciones_Semanales::with('usuario')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'semana' => 'required|string|max:20',
            'recomendacion' => 'required|string'
        ]);

        return Recomendaciones_Semanales::create($request->all());
    }

    public function show($id)
    {
        return Recomendaciones_Semanales::with('usuario')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $rec = Recomendaciones_Semanales::findOrFail($id);
        $rec->update($request->all());

        return $rec;
    }

    public function destroy($id)
    {
        Recomendaciones_Semanales::destroy($id);
        return response()->json(['mensaje' => 'Recomendación eliminada']);
    }
}
