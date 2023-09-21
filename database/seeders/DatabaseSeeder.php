<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'it-gates',
            'email' => 'it-gates@gmail.com',
            'password' => 'password',
        ]);

        \App\Models\Todo::factory(10)->create();
    }
}
