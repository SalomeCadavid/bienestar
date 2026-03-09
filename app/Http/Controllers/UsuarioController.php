<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::with('role')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
            'rol_id' => 'required|exists:roles,id',
            'peso' => 'nullable|numeric',
            'estatura' => 'nullable|numeric'
        ]);

        $imcCalculado = null;

        if ($request->peso && $request->estatura) {
            $alturaMetros = $request->estatura / 100;
            $imcCalculado = $request->peso / ($alturaMetros * $alturaMetros);
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'edad' => $request->edad,
            'peso' => $request->peso,
            'estatura' => $request->estatura,
            'genero' => $request->genero,
            'imc' => $imcCalculado ? round($imcCalculado, 2) : null,
            'rol_id' => $request->rol_id
        ]);

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        return Usuario::with('role')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $datos = $request->except('password');

        if ($request->peso && $request->estatura) {
            $alturaMetros = $request->estatura / 100;
            $datos['imc'] = round(
                $request->peso / ($alturaMetros * $alturaMetros),
                2
            );
        }

        $usuario->update($datos);

        if ($request->password) {
            $usuario->password = Hash::make($request->password);
            $usuario->save();
        }

        return $usuario;
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->json(['mensaje' => 'Usuario eliminado']);
    }

    public function calcularImc(Request $request)
{
    $request->validate([
        'peso' => 'required|numeric',
        'estatura' => 'required|numeric',
        'genero' => 'nullable|string',
        'edad' => 'nullable|integer'
    ]);

    $alturaMetros = $request->estatura / 100;
    $imc = $request->peso / ($alturaMetros * $alturaMetros);
    $imc = round($imc, 2);

    if ($imc < 18.5) {
        $clasificacion = "Bajo peso";
        $plan = "Plan de aumento de masa muscular";
    } elseif ($imc >= 18.5 && $imc < 25) {
        $clasificacion = "Normal";
        $plan = "Plan de mantenimiento";
    } elseif ($imc >= 25 && $imc < 30) {
        $clasificacion = "Sobrepeso";
        $plan = "Plan de pérdida de grasa";
    } else {
        $clasificacion = "Obesidad";
        $plan = "Plan intensivo";
    }

    return response()->json([
        'imc' => $imc,
        'clasificacion' => $clasificacion,
        'plan_recomendado' => $plan
    ]);
}
    
}
