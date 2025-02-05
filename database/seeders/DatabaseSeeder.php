<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            SkillSeeder::class,
            EventSeeder::class,
            EventCategorySeeder::class,
            EventSkillSeeder::class,
            UserSkillSeeder::class,
            UserCategorySeeder::class,
            QuestionsSeeder::class,
            VolunteerSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
