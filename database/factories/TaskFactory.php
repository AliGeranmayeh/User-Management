<?php

namespace Database\Factories;

use App\Helpers\Enums\TaskStatus;
use App\Models\Goal;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "goal_id" => Goal::inRandomOrder()->first()->id,
            'title' => $this->faker->title(),
            'description' => $this->faker->text(60),
            'weight' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'status' => $this->faker->randomElement([TaskStatus::PENDING, TaskStatus::FINISHED, TaskStatus::IN_PROGRESS, TaskStatus::STOP]),
        ];
    }
}
