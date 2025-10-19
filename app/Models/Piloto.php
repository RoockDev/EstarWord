<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{

    use HasFactory;

    //un piloto puede tener muchas naves y una nava muchos pilotos
    public function naves(){
        $this->belongsToMany(
            Nave::class, //modelo
            'nave_piloto', //tabla pivote
            'piloto_id', //clave foranea local
            'nave_id', //clave foranea del otro modelo
        )->withPivot('fecha_asociacion','fecha_fin_asociacion');
    }
}
