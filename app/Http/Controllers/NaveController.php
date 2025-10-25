<?php

namespace App\Http\Controllers;

use App\Models\Nave;
use App\Models\Piloto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

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
        $reglas = [
            'nombre' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'tripulacion' => 'required|integer|min:1',
            'pasajeros' => 'required|integer|min:0',
            'clase_nave' => 'required|string',
            'planeta_id' => 'required|integer|exists:planetas,id'
        ];

        $validator = Validator::make($request->all(),$reglas);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ],400);
        }
        $nave = Nave::create($request->all());

        return response()->json($nave, 201);
    }

    /* PUT /api/naves/{nave} */
    public function update(Request $request, Nave $nave){
        $reglas = [
            'nombre' => 'sometimes|string|max:255',
            'modelo' => 'sometimes|string|max:255',
            'tripulacion' => 'sometimes|integer|min:1',
            'pasajeros' => 'sometimes|integer|min:0',
            'clase_nave' => 'sometimes|string',
            'planeta_id' => 'sometimes|integer|exists:planetas,id'
        ];
        
        $validator = Validator::make($request->all(),$reglas);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ],400);
        }
        $nave->update($request->all());
        return response()->json($nave,200);
    }

    /* DELETE /api/naves/{nave} */
    public function destroy(Nave $nave){
        $nave->delete();
        return response()->json(["Exito"=> "Nave eliminada correctamente"],200);
    }

    /**asignar piloto a nave */

    public function asignarPiloto(Request $request, Nave $nave){
        
        $validator = Validator::make($request->all(),[
            'piloto_id' => 'required|integer|exists:pilotos,id'
        
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()],400);
        }

        $yaEstaAsignado = $nave->pilotos()
                                ->where('piloto_id',$request->piloto_id)
                                ->whereNull('fecha_fin_asociacion')
                                ->exists();
        if ($yaEstaAsignado) {
            return response()->json(["Error" => "Ese piloto ya esta asignado a esa nave"], 409);
        }

        $nave->pilotos()->attach($request->piloto_id, ['fecha_asociacion' => now()]);
        return response()->json(["success" => "Piloto asinado correctamente"], 201);

    }

    /**Desasignar piloto a nave */
    public function desasignarPiloto(Request $request, Nave $nave){
        $validator = Validator::make($request->all(),[
            'piloto_id' => 'required|integer|exists:pilotos,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()],400);
        }

        $pilotoId = $request->piloto_id;
        

        $yaEstaAsginado = $nave->pilotos()
                                ->where('piloto_id',$pilotoId)
                                ->whereNull('fecha_fin_asociacion')
                                ->exists();
        if (!$yaEstaAsginado) {
            return response()->json(["Error" => "El piloto no está asignado a la nave"], 409);
        } 
            /**
             * Como lo que queremos es saber que fecha fin de asociacion hay entre el piloto
             * y la nave de la tabla pivote, si hiciesemos un detach borrariamos y no tendria
             * ningun sentido pero con la funcion de eloquent updateExistingPivot() , actualizamos
             * una fila de una tabla intermediaria como puede ser nave_piloto
             */
            $nave->pilotos()->updateExistingPivot($pilotoId,['fecha_fin_asociacion' => now()]);
            return response()->json(["succes" => "Piloto desasignado con exito"], 200);
        
    }

    /**Listar todas las naves que no tengan piloto */
    /**Get /api/navesSinPiloto */
    public function navesSinPiloto(){
        /**Aqui necesitamos comprobar dos cosas, una las naves que no tienen relacion
         * con la tabla pivote ya que no tienen pilotos y las naves que si tienen relacion
         * con la tabla pivote pero tienen una fecha_fin_asociacion con el piloto
         * y con el metodo whereDoesntHave de eloquent podemos conseguirlo
         * hacer dos en uno
         */

        $naves = Nave::whereDoesntHave('pilotos', function($query){
            $query->whereNull('fecha_fin_asociacion');
        })->get();

        return response()->json($naves);
    }


        
    




}
