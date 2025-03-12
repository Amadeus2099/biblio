<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'autor' => fake()->name(),
            'editorial' => fake()->company(),
            'año' => fake()->year(),
            'estado' => fake()->randomElement(['disponible', 'prestado', 'deteriorado']),
            'existencia' => fake()->numberBetween(1, 10),
        ];
    }
}
