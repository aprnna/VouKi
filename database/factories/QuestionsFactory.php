<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questions>
 */
class QuestionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $event = Event::inRandomOrder()->first();

        return [
            'event_id' => $event->id,
            'question' => $this->faker->sentence(),
            'status' => $this->faker->boolean(true),
            'created_at' => $event->EventStart,
            'updated_at' => $event->EventStart,
        ];
    }
}
