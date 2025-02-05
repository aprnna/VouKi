<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use App\Models\VolunteerEvent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class VolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = VolunteerEvent::class;

    public function definition(): array
    {
        $volunteer = User::where('role', 'volunteer')->inRandomOrder()->first();
        $event = Event::inRandomOrder()->first();

        return [
            'event_id' => $event->id,
            'user_id' => $volunteer->id,
            'user_acceptance_status' => 'accepted',
            'user_rating' => $this->faker->numberBetween(3, 5),
            'user_review' => $this->faker->sentence(),
            'event_rating' => $this->faker->numberBetween(3, 5),
            'status' => $this->faker->boolean(true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
