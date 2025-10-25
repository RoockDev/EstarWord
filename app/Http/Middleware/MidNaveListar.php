<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MidNaveListar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    $usuario = $request->user();
    if ($usuario && ($usuario->tokenCan('nave:listar') || $usuario->tokenCan('admin'))) {
        return $next($request); 
    }

    return response()->json(["success" => false, "message" => "no tienes permiso para ver este recurso" ]);
       
    }
}
