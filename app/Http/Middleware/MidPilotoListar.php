<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MidPilotoListar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();

        if ($usuario && ($usuario->tokenCan('piloto:listar') || $usuario->tokenCan('admin'))) {
            return $next($request);
        }

        return response()->json(["success" => false, "message" => "no tienes permisos para acceder a este recurso"],403);
        
    }
}
