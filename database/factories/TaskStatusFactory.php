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
            'name' => $this->faker->word,
            'id' => $this->faker->numberBetween(1, $maxId)
        ];
    }
}
