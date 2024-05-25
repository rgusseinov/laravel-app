<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = TaskStatus::factory()->create();
        $user = User::factory()->create();
        
        return [
            'name' => fake()->sentence(3),
            'status_id' => $status->id,
            'executor_id' => $user->id,
            'author_id' => $user->id
        ];
    }
}
