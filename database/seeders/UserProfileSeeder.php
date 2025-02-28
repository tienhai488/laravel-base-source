<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::count()) {
            return;
        }

        User::whereDoesntHave('userProfile')
            ->lazy(1000)
            ->each(function ($user) {
                $user->userProfile()->create();
            });
    }
}
