<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 1000 users
        User::factory(1000)->create();

        // create a static admin user
        User::create([
            'email' => 'admin@demo.com',
            'password' => Hash::make('password'),
            'name' => 'Admin',
            'is_admin' => true,
        ]);

        // Now we will create a normal user
        User::create([
            'email' => 'user@demo.com',
            'password' => Hash::make('password'),
            'name' => 'User',
            'is_admin' => false,
        ]);

        // we will create 1000 tasks
        Task::factory(1000)->create();
    }
}
