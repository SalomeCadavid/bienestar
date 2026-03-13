<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // LISTAR USUARIOS
    public function index()
    {
        return response()->json(User::all());
    }

    // CREAR USUARIO
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json($user, 201);
    }

    // MOSTRAR USUARIO
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // ACTUALIZAR USUARIO
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email
        ]);

        return response()->json($user);
    }

    // ELIMINAR USUARIO
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            "message" => "Usuario eliminado"
        ]);
    }
}