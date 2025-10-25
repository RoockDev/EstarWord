<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sail\SailServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class MidAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();

        if ($usuario && $usuario->tokenCan('admin')) {
            return $next($request);
        }

        return response()->json(["success" => false, "message" => "No autorizado, se requieren permisos de administrador"],403);
        
    }
}
