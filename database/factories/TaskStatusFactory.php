<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskStatusFactory extends Factory
{
    protected $model = TaskStatus::class;

    public function definition()
    {
        $maxId = TaskStatus::max('id');

        return [
            'id' => $maxId + 1,
            'name' => fake()->word()
        ];
    }
}
