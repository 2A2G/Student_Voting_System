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

        // User::factory()->create([
        //     'name' => 'Aldair',
        //     'email' => 'admin@INEFRAPASA.com',
        // ]);

        User::factory(1)->create();
        $this->call(RoleSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(EstudianteSeeder::class);
    }
}
