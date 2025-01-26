<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organizer_id' => User::where('role', 'organizer')->inRandomOrder()->first()->id,
            'title' => fake()->name(),
            'description' => fake()->sentence(),
            'max_volunteers' => fake()->numberBetween(1, 100),
            'RegisterStart' => fake()->dateTimeBetween('now', '+1 month'),
            'RegisterEnd' => fake()->dateTimeBetween('+1 month', '+2 month'),
            'EventStart' => fake()->dateTimeBetween('+2 month', '+3 month'),
            'EventEnd' => fake()->dateTimeBetween('+3 month', '+4 month'),
        ];
    }
}
