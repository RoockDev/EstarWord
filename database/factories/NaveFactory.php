<?php

namespace Database\Factories;

use App\Models\Planeta;
use App\Models\Nave;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nave>
 */
class NaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique->firstName(). ' ' .$this->faker->randomLetter(),
             'modelo' => $this->faker->word() . '_' .$this->faker->randomNumber(4,true),
             'tripulacion' => $this->faker->numberBetween(1,100),
             'pasajeros' => $this->faker->numberBetween(0,500),
             'clase_nave' => $this->faker->randomElement(['Starfighter', 'Freighter', 'Capital Ship']),
            'planeta_id' => $this->faker->randomElement(Planeta::pluck('id')),
            
        ];
    }
}
