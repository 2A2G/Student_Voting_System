<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numeroIdentidad' => $this->faker->unique()->randomNumber(9),
            'nombreEstudiante' => $this->faker->firstName(),
            'apellidoEstudiante' => $this->faker->lastName(),
            'curso_id' => $this->faker->randomElement(Curso::pluck('id')->toArray())

        ];
    }
}
