<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nave extends Model
{
    //una nave pertenece a un solo planeta
    public function planeta(){
        return $this->belongsTo(Planeta::class);
    }

    //una nava puede tener varios mantenimientos
    public function mantenimientos(){
        return $this->hasMany(Mantenimiento::class);
    }

    public function pilotos(){ 
        return $this->belongsToMany(
            Piloto::class, //modelo
            'nave_piloto', //tabla pivote
            'nave_id', // clave foranea local (en pivot)
            'piloto_id' //clave foranea del otro modelo (en pivot)
        )->withPivot('fecha_asociacion','fecha_fin_asociacion');
    }


}
