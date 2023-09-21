<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'notes' => fake()->paragraph,
            'due_date' => fake()->dateTimeBetween('now', '+7 days'),
            'is_completed' => fake()->boolean,
            'user_id' => User::first()->id
        ];
    }
}
