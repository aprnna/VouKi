<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //'
        User::factory(10)->create()->each(function ($user) {
            $user->userDetail()->save(UserDetail::factory()->make(['user_id' => $user->id]));
        });
    }
}
