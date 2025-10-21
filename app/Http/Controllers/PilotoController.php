<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piloto;

class PilotoController extends Controller
{
    
    /**Listar todos los pilotos asignados a naves (historicos no tienen por que estar asignados actualmente) */
    /**Get /historicoPilotosAsignados */
    public function listarHistoricoPilotosAsignados(){
        $pilotos = Piloto::has('naves')->get();
        if ($pilotos->isEmpty()) {
            return response()->json(["error" => "ningun piloto ha sido asignado todavia a ninguna nava"],404);
        }else{
            return response()->json($pilotos,200);
        }
        
    }

    /**Listar todos los pilotos que actualmente estan asignados a naves y las naves */
    /**Get /pilotosAsignadosActualmente */
    public function pilotosAsignadosActualmente(){

        /**aqui baicamente traemos los pilotos que cumplen esa condicion
         * y con wl with lo que hacemos es traer tambien la nave asociada
         * a ese piloto
         */
        $pilotos = Piloto::whereHas('naves', function ($query){
            $query->whereNull('fecha_fin_asociacion');
        })->with('naves') //Carga las naves de cada piloto
            ->get(); 
            
        return response()->json($pilotos);
    }
}
