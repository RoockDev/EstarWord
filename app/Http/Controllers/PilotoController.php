<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piloto;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PilotoController extends Controller
{

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'altura' => 'required|integer|min:50',
            'ano_nacimiento' => 'required|string|max:50',
            'genero' => 'required|string|max:50',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
             'errors' => $validator->errors()   
            ],400);
        }
        $datosPiloto = $request->all();

        $datosPiloto['foto_url'] = asset('images/piloto_generico.png');

        $piloto = Piloto::create($datosPiloto);

        return response()->json([
            'message' => 'Piloto creado con éxito',
            'piloto' => $piloto
        ],201);

    }





    /**Listar todos los pilotos asignados a naves (historicos no tienen por que estar asignados actualmente) */
    /**Get /historicoPilotosAsignados */
    public function listarHistoricoPilotosAsignados()
    {
        $pilotos = Piloto::has('naves')->get();
        if ($pilotos->isEmpty()) {
            return response()->json(["error" => "ningun piloto ha sido asignado todavia a ninguna nava"], 404);
        } else {
            return response()->json($pilotos, 200);
        }
    }

    /**Listar todos los pilotos que actualmente estan asignados a naves y las naves */
    /**Get /pilotosAsignadosActualmente */
    public function pilotosAsignadosActualmente()
    {

        /**
         * con esto traemos los pilotos que tienen al menos una nave con fecha_fin null
         * pero con with naves traemos todas las naves del piloto aunque ya no esten asignadas
         * por eso sale la fecha fin tambien por lo tanto el de abajo no
         */
        /*$pilotos = Piloto::whereHas('naves', function ($query){
            $query->whereNull('fecha_fin_asociacion');
        })->with('naves')->get(); */
        $pilotos = Piloto::whereHas('naves', function ($query) {
            $query->whereNull('fecha_fin_asociacion');
        })
            ->with(['naves' => function ($query) {
                $query->whereNull('fecha_fin_asociacion');
            }])->get();


        return response()->json($pilotos,200);
    }

    public function subirFotoCloud(request $request, Piloto $piloto)
    {
        $messages = [
            'image.required' => 'Falta el archivo',
            'image.mimes' => 'Tipo no soportado (solo jpeg,png,jpg,gif)',
            'image.max' => 'El archivo excede el tamaño maximo'
        ];

        $validator = Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ],400);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid('piloto_' . $piloto->id . '_') . Str::slug($originalName) . '.' . $extension;

            try{
                
                //se sube el archivo al disco cloudinary
                //se usa "PutFileAs" para forzar la carpeta "laravel"
                $uploadedFilePath = Storage::disk('cloudinary')->putFileAs('laravel', $file, $filename);
                $url = Storage::disk('cloudinary')->url($uploadedFilePath);

                //se actualiza el piloto en la bbdd
                $piloto->foto_url = $url;
                $piloto->save();

                return response()->json([
                    'message' => 'Foto de perfil actualizada con exito',
                    'piloto' => $piloto,
                    'url_nueva' => $url
                ],200);



            }catch(Exception $e){
                return response()->json(['error' => 'Error al subir la imagen' - $e->getMessage()]);
            }


        }

        return response()->json(['error' => 'No se recibió ningún archivo válido'],400);

    }

    public function destroy(Piloto $piloto){
        $piloto->delete();

        return response()->json([
            'message' => 'Piloto eliminado con exito'
        ],200);
    }
}
