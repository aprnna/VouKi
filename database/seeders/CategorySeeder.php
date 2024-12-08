<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'music', 'sport', 'education', 'technology', 'art', 'fashion', 'food', 'other'
        ];

        $data = [];
        foreach ($categories as $index => $category) {
            $data[] = [
                'category' => $category,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }


        Categories::insert($data);
    }
}
