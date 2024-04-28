<?php

namespace App\Helpers\DB;

use App\Models\Task;
use App\Helpers\Enums\TaskStatus;

class TaskRepository
{

    public static function create($data)
    {
        return Task::create([
            'title' => $data->title,
            'description' => $data->description,
            'start_date' => $data->start_date,
            'do_date' => $data->do_date,
            'goal_id' => $data->goal_id,
            'weight' => $data->weight,
            'status' => TaskStatus::PENDING,
        ]) ?? null;
    }

    public static function update(Task $task, array $data)
    {
        try {
            $task->update($data);
        }
        catch (\Throwable $th) {
            return [null, false];
        }
        return [$task, true];
    }

    public static function delete(Task $task)
    {
        try {
            $task->delete();
        }
        catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
