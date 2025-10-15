<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planeta extends Model
{
    // un planeta puede tener varias naves
    public function naves(){
        return $this->hasMany(Nave::class);
    }
}
