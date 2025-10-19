<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planeta extends Model
{

    use HasFactory; 
    // un planeta puede tener varias naves
    public function naves(){
        return $this->hasMany(Nave::class);
    }
}
