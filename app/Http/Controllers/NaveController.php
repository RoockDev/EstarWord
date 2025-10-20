<?php

namespace App\Http\Controllers;

use App\Models\Nave;
use App\Models\Piloto;
use Illuminate\Http\Request;

class NaveController extends Controller
{
    /* GET /api/naves */
    public function index(){
        $naves = Nave::all();

        return response()->json($naves);
    }

    /* GET /api/naves{nave} */
    public function show(Nave $nave){
        return response()->json($nave);
    }

    /* POST /api/naves */
    public function store(Request $request){
        $nave = Nave::create($request->all());

        return response()->json($nave, 201);
    }

    /* PUT /api/naves/{nave} */
    public function update(Request $request, Nave $nave){
        $nave->update($request->all());
        return response()->json($nave,200);
    }

    /* DELETE /api/naves/{nave} */
    public function destroy(Nave $nave){
        $nave->delete();
        return response()->json(["Exito"=> "Nave eliminada correctamente"],204);
    }

    /**asignar piloto a nave */
    public function asginarPiloto(Request $request, Nave $nave){
        
        $piloto = Piloto::find($request->piloto_id);
        if (!$piloto) {
            return response()->json(["Error" => "Piloto no encontrado"],404);
        }

        $nave->pilotos()->attach($piloto->id);
        return response()->json(["succes" => "Piloto asinado correctamente"]);

    }
        
    




}
