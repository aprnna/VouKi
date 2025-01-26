<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = Skill::all();
        $events = Event::all();

        foreach ($events as $event) {
            $randomSkills = $skills->random(min(3, $skills->count()))->pluck('id')->toArray();
            $event->skills()->attach($randomSkills);
        }
    }
}
