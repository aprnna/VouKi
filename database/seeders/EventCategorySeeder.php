<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $events = Event::all();

        foreach ($events as $event) {
            $randomCategories = $categories->random(min(3, $categories->count()))->pluck('id')->toArray();
            $event->categories()->attach($randomCategories);
        }
    }
}
