<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombreCargo' => $this->faker->unique()->randomElement(['Representante de Curso', 'Contralor', 'Personero']),
            'descripcionCargo' => $this->faker->text(100),
        ];
    }
}
