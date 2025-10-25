<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mantenimiento;
use App\Models\Nave;
use Illuminate\Support\Facades\Validator;

class MantenimientoController extends Controller
{
    /**registrar un mantenimiento */
    /**Post /api/naves/{nave}/mantenimientos */
    public function store(Request $request, Nave $nave){

        $reglas = [
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'coste' => 'required|numeric|min:0'
        ];

        $validator = Validator::make($request->all(),$reglas);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ],400);
        }


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
    public function mantenimientosEntreFechas($request){
       

        $validator = Validator::make($request->all(),[
            'inicio' => 'required|date',
            'fin' => 'require|date|after_or_equal:inicio'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ],400);
        }

        $inicio = $request->input('inicio');
        $fin = $request->input('fin');

        $mantenimientos = Mantenimiento::whereBetween('fecha', [$inicio,$fin])->get();

        return response()->json([
            "mantenimientos" => $mantenimientos
        ],200);
    }

}
