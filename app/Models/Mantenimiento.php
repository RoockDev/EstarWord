<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function calcularCostePorDias($fechaInicio,$fechaFin){
        $costePorDia = 100;

        $inicio = Carbon::parse($fechaInicio);
        $fin = Carbon::parse($fechaFin);

        //diffnDays calcula la diferencia de dias enteros
        //sumamos 1 por si el mantenmiento empieza y termina hoy que sume 1 dia no 0
        $dias = $inicio->diffInDays($fin) + 1;
        return $dias * $costePorDia;

    }
}
