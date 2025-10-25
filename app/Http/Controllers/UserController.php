<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function updateRole(Request $request,User $user){
        $validator = Validator::make($request->all(),[
            'role' => ['required', 'string', Rule::in(['admin','gestor','usuario'])]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json([
            'message' => 'Rol del usuario actualizado correctamente',
            'user' => $user
        ],200);
    }
}
