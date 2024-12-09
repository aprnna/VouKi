<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'it',
            'design',
            'marketing',
            'finance',
            'comunication',
            'leader',
            'other'
        ];

        $data = [];
        foreach ($skills as $index => $skills) {
            $data[] = [
                'skill' => $skills,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Skill::insert($data);
    }
}
