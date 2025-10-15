<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    //un mantenimiento pertenece a una nave
    public function nave(){
        return $this->belongsTo(Nave::class);
    }
}
