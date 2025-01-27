<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'skill_id' => Skill::factory(),
            'event_id' => Event::factory(),
        ];
    }
}
