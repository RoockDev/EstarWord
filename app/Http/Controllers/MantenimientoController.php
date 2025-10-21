<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mantenimiento;
use App\Models\Nave;

class MantenimientoController extends Controller
{
    /**registrar un mantenimiento */
    /**Post /api/naves/{nave}/mantenimientos */
    public function store(Request $request, Nave $nave){
        $mantenimiento = $nave->mantenimientos()->create($request->all());
        return response()->json([
            "Succes" => "Mantenimiento creado correctamente",
            "mantenimiento" => $mantenimiento
        ], 201);
    }

    /**Listar mantenimientos puntuales */
    /**Get /api/mantenimientos/{mantenimiento} */
    public function show(Mantenimiento $mantenimiento){
        return response()->json($mantenimiento,200);
    }

    /**Listar mantenimientos de naves entre dos fechas */
    /**Get /api/mantenimientos?inicio=yyyy-mm-dd & fin=yyyy-mm-dd */
    public function mantenimientosEntreFechas(Request $request){
        $inicio = $request ->query('inicio');
        $fin = $request->query('fin');

        if (!$inicio || $fin) {
            return response()->json([
                "error" => "tienes que introducir fecha inicio y fecha fin"
            ],400);
        }

        $mantenimientos = Mantenimiento::whereBetween('fecha', [$inicio,$fin])->get();

        return response()->json([
            "mantenimientos" => $mantenimientos
        ],200);
    }

}
