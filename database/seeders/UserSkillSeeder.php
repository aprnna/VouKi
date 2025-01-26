<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = Skill::all();
        $users = User::all();

        foreach ($users as $user) {
            $randomSkills = $skills->random(min(3, $skills->count()))->pluck('id')->toArray();
            $user->skills()->attach($randomSkills);
        }
    }
}
