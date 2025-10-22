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

        /**
         * con esto traemos los pilotos que tienen al menos una nave con fecha_fin null
         * pero con with naves traemos todas las naves del piloto aunque ya no esten asignadas
         * por eso sale la fecha fin tambien por lo tanto el de abajo no
         */
        /*$pilotos = Piloto::whereHas('naves', function ($query){
            $query->whereNull('fecha_fin_asociacion');
        })->with('naves')->get(); */
         $pilotos = Piloto::whereHas('naves',function ($query) {
            $query->whereNull('fecha_fin_asociacion');
         })
         ->with(['naves' => function ($query){
            $query->whereNull('fecha_fin_asociacion');
         }]);
        
            
        return response()->json($pilotos);
    }
}
