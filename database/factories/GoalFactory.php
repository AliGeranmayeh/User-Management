<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    //     $startDate = $this->faker->dateTimeBetween("2015-07-12", now());
    //     $endDate = $this->faker->dateTimeBetween($startDate->modify('+1 day')->format('Y-m-d'),  $startDate->modify('+1 week')->format('Y-m-d'));
    //     $doDate = $this->faker->dateTimeBetween($endDate, $endDate->modify("+1 day")->format('Y-m-d'));
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(50),
            'start_date' => $this->faker->dateTime()->format('d-m-Y H:i:s'),
            'end_date' => $this->faker->dateTime()->format('d-m-Y H:i:s'),
            'do_date' => $this->faker->dateTime()->format('d-m-Y H:i:s'),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
