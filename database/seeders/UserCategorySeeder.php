<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $users = User::all();

        foreach ($users as $user) {
            $randomCategory = $categories->random(min(3, $categories->count()))->pluck('id')->toArray();
            $user->categories()->attach($randomCategory);
        }
    }
}
