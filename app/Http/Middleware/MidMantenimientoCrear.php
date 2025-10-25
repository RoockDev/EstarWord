<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MidMantenimientoCrear
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $usuario = $request->user();
        if ($usuario && ($usuario->tokenCan('mantenimiento:crear') || $usuario->tokenCan('admin') )) {
            return $next($request);
        }

        return response()->json(["succes" => false, "message" => "no tienes permisos para acceder a este recurso"],403);
        
    }
}
