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
            'rol_id' => 'required|exists:roles,id'
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'edad' => $request->edad,
            'peso' => $request->peso,
            'estatura' => $request->estatura,
            'genero' => $request->genero,
            'imc' => $request->imc,
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

        $usuario->update($request->except('password'));

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
}
