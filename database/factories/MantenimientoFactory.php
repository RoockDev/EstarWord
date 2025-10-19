<?php

namespace Database\Factories;

use App\Models\Nave;
use App\Models\Mantenimiento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mantenimiento>
 */
class MantenimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date(),
            'descripcion' => $this->faker->sentence(),
            'coste' => $this->faker->randomFloat(2, 500,20000),
            'nave_id' => $this->faker->randomElement(Nave::pluck('id')),
            
        ];
    }
}
