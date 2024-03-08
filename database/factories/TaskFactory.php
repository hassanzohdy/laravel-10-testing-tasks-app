<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Users list
     */
    protected static $users = [
        "admin" => [],
        "user" => [],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (empty(static::$users['admin'])) {
            [$admin, $user] = User::all()->partition(fn ($user) => $user->is_admin);

            static::$users = [
                "admin" => $admin,
                "user" => $user,
            ];
        }

        return [
            'title' => fake()->text(40),
            "description" => fake()->text(100),
            'status' => fake()->randomElement(['open', 'closed']),
            'assigned_to' => static::$users["user"]->random()->id,
            'admin_id' => static::$users["admin"]->random()->id,
        ];
    }
}
