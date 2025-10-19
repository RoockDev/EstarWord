<?php

namespace Database\Factories;
use App\Models\Piloto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Piloto>
 */
class PilotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>$this->faker->name(),
            'altura' => $this->faker->numberBetween(150,220),
            'ano_nacimiento' => $this->faker->numberBetween(1950,2007),
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino', 'Extraterrestre'])
        ];
    }
}
