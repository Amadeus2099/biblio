<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestamo>
 */
class PrestamoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'libro_id' => Libro::inRandomOrder()->first()->id ?? Libro::factory(),
            'fecha_prestamo' => now(),
            'fecha_entrega' => now()->addDays(fake()->numberBetween(7, 30)), // Fecha aleatoria entre 7 y 30 días después
        ];
    }
}
