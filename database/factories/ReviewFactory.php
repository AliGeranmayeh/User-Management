<?php

namespace Database\Factories;

use App\Helpers\Enums\ReviewQuality;
use App\Models\Goal;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
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
            'question' => $this->faker->text(50),
            "result_point" =>$this->faker->randomElement([ReviewQuality::PERFECT,ReviewQuality::OK ,ReviewQuality::GOOD,ReviewQuality::BAD]),
            "result_quality" => $this->faker->randomElement([1,2,3,4,5])
        ];
    }
}
