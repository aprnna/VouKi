<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Skill;

class EventSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $event =  Event::all();
        $skills = Skill::all();

        $event->each(function ($event) use ($skills) {
            $event->skills()->attach(
                $skills->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
