<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        // Convertimos los roles a números
        $rolesMap = [
            'admin' => 1,
            'cliente' => 2,
        ];

        $allowedRoles = [];

        foreach ($roles as $role) {
            if (isset($rolesMap[$role])) {
                $allowedRoles[] = $rolesMap[$role];
            }
        }

        if (!in_array($request->user()->rol_id, $allowedRoles)) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return $next($request);
    }
}

