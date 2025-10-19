<?php

namespace App\Http\Controllers;

use App\Models\Nave;
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




}
