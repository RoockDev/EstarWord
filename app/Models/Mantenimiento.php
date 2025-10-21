<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'descripcion', 'coste','nave_id'];
    
    //un mantenimiento pertenece a una nave
    public function nave(){
        return $this->belongsTo(Nave::class);
    }
}
