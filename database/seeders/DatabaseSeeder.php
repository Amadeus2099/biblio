<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Enrique Amadeus',
            'apellido' => 'Rodríguez Torreblanca',
            'telefono' => '4441903506',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminAmadues31'), // Cambia la contraseña si es necesario
            'tipo' => 'admin',
        ]);
    }
}
