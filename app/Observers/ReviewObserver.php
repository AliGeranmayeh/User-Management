<?php

namespace App\Observers;

use App\Helpers\Enums\ReviewQuality;
use App\Models\Goal;
use App\Models\Review;
use App\Models\Task;

class ReviewObserver
{

    private $qualities = [
        ReviewQuality::PERFECT => 100,
        ReviewQuality::GOOD => 75,
        ReviewQuality::OK => 50,
        ReviewQuality::BAD => 25,
    ];
    private $points = [
        1 => 1 / 5,
        2 => 2 / 5,
        3 => 3 / 5,
        4 => 4 / 5,
        5 => 1,
    ];
    /**
     * Handle the Review "created" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        $reviewWeightedSum = 0;
        $reviews = Review::pluck("result_point", "result_quality")->toArray();
        foreach ($reviews as $value) {
            $reviewWeightedSum += $this->qualities[$value->result_quality] * $this->points[$value->result_point];
        }
        $reviewAVG = $reviewWeightedSum / count($reviews);

        $taskWeightedSum = 0;
        $tasks = Task::pluck("weight", "status")->toArray();
        foreach ($tasks as $task) {
            $taskWeightedSum += $task->status * $task->weight;
        }
        $taskAVG = $taskWeightedSum / count($tasks);

        Goal::where('id', $review->goal_id)->update(['point' => $reviewAVG * $taskAVG]);
    }

    /**
     * Handle the Review "updated" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        $reviewWeightedSum = 0;
        $reviews = Review::pluck("result_point", "result_quality")->toArray();
        foreach ($reviews as $value) {
            $reviewWeightedSum += $this->qualities[$value->result_quality] * $this->points[$value->result_point];
        }
        $reviewAVG = $reviewWeightedSum / count($reviews);

        $taskWeightedSum = 0;
        $tasks = Task::pluck("weight", "status")->toArray();
        foreach ($tasks as $task) {
            $taskWeightedSum += $task->status * $task->weight;
        }
        $taskAVG = $taskWeightedSum / count($tasks);

        Goal::where('id', $review->goal_id)->update(['point' => $reviewAVG * $taskAVG]);
    }

    /**
     * Handle the Review "deleted" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        $reviewWeightedSum = 0;
        $reviews = Review::pluck("result_point", "result_quality")->toArray();
        foreach ($reviews as $value) {
            $reviewWeightedSum += $this->qualities[$value->result_quality] * $this->points[$value->result_point];
        }
        $reviewAVG = $reviewWeightedSum / count($reviews);

        $taskWeightedSum = 0;
        $tasks = Task::pluck("weight", "status")->toArray();
        foreach ($tasks as $task) {
            $taskWeightedSum += $task->status * $task->weight;
        }
        $taskAVG = $taskWeightedSum / count($tasks);

        Goal::where('id', $review->goal_id)->update(['point' => $reviewAVG * $taskAVG]);
    }
}
