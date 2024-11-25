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
            'organizer_id' => User::factory(['role' => 'organizer']),
            'title' => fake()->name(),
            'description' => fake()->sentence(),
            'banner' =>  "images/events/xtU4O3zOueyraMI95aQvBOLa9ETmD6JsOnB6f87Z.jpg",
            'max_volunteers' => fake()->numberBetween(1, 100),
            'RegisterStart' => fake()->dateTimeBetween('now', '+1 month'),
            'RegisterEnd' => fake()->dateTimeBetween('+1 month', '+2 month'),
            'EventStart' => fake()->dateTimeBetween('+2 month', '+3 month'),
            'EventEnd' => fake()->dateTimeBetween('+3 month', '+4 month'),
            'category' => fake()->randomElement(['music', 'sport', 'education', 'technology', 'art', 'fashion', 'food', 'other']),
            'prefered_skills' => fake()->randomElement(['it', 'design', 'marketing', 'finance', 'comunication', 'leader', 'other']),
        ];
    }
}
