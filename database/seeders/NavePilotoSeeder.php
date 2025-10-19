<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Piloto;
use App\Models\Nave;

class NavePilotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $naves = Nave::all();
        $pilotos = Piloto::all();

        foreach($naves as $nave){
            $piloto_asignado = $pilotos->random(rand(1,3));

            foreach ($piloto_asignado as $piloto) {
                $nave->pilotos()->attach($piloto->id, [
                    'fecha_asociacion' => fake()->dateTimeBetween('-2 years', 'now'),
                ]);
            }
        }
    }
}
