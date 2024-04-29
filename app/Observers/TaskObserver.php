<?php

namespace App\Observers;

use App\Models\Task;
use App\Helpers\Enums\ReviewQuality;
use App\Models\Goal;
use App\Models\Review;

class TaskObserver
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
     * Handle the Task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $reviewWeightedSum = 0;
        $reviews = Review::pluck("result_point", "result_quality")->toArray();
        foreach ($reviews as $review) {
            $reviewWeightedSum += $this->qualities[$review->result_quality] * $this->points[$review->result_point];
        }
        $reviewAVG = $reviewWeightedSum / count($reviews);

        $taskWeightedSum = 0;
        $tasks = Task::pluck("weight", "status")->toArray();
        foreach ($tasks as $value) {
            $taskWeightedSum += $value->status * $value->weight;
        }
        $taskAVG = $taskWeightedSum / count($tasks);

        Goal::where('id', $task->goal_id)->update(['point' => $reviewAVG * $taskAVG]);
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        $reviewWeightedSum = 0;
        $reviews = Review::pluck("result_point", "result_quality")->toArray();
        foreach ($reviews as $review) {
            $reviewWeightedSum += $this->qualities[$review->result_quality] * $this->points[$review->result_point];
        }
        $reviewAVG = $reviewWeightedSum / count($reviews);

        $taskWeightedSum = 0;
        $tasks = Task::pluck("weight", "status")->toArray();
        foreach ($tasks as $value) {
            $taskWeightedSum += $value->status * $value->weight;
        }
        $taskAVG = $taskWeightedSum / count($tasks);

        Goal::where('id', $task->goal_id)->update(['point' => $reviewAVG * $taskAVG]);
    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $reviewWeightedSum = 0;
        $reviews = Review::pluck("result_point", "result_quality")->toArray();
        foreach ($reviews as $review) {
            $reviewWeightedSum += $this->qualities[$review->result_quality] * $this->points[$review->result_point];
        }
        $reviewAVG = $reviewWeightedSum / count($reviews);

        $taskWeightedSum = 0;
        $tasks = Task::pluck("weight", "status")->toArray();
        foreach ($tasks as $value) {
            $taskWeightedSum += $value->status * $value->weight;
        }
        $taskAVG = $taskWeightedSum / count($tasks);

        Goal::where('id', $task->goal_id)->update(['point' => $reviewAVG * $taskAVG]);
    }
}
