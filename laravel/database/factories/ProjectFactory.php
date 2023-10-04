<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('usertype', 'like', 'ip')->get()->random()->id,
            'name' => fake()->words(6, true),
            'description' => fake()->text(150),
            'capacity' => fake()->numberBetween(3, 6),
            'email' => fake()->unique()->safeEmail(),
            'offer_year' => 2024,
            'offer_trimester' => fake()->numberBetween(1, 3),
        ];
    }
}
