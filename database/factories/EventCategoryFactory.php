<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'event_id' => Event::factory(),
        ];
    }
}
