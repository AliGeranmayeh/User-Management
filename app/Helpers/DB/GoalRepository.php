<?php

namespace App\Helpers\DB;

use App\Models\Goal;

class GoalRepository
{

    public static function create($data)
    {
        return Goal::create([
            'title' => $data->title,
            'description' => $data->description,
            'start_date' => $data->start_date,
            'do_date' => $data->do_date,
            'user_id' => $data->user_id,
        ]) ?? null;
    }

    public static function update(Goal $goal, array $data)
    {
        try {
            $goal->update($data);
        } catch (\Throwable $th) {
            return [null, false];
        }
        return [$goal, true];
    }

    public static function delete(Goal $goal)
    {
        try {
            $goal->delete();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }


    public static function find(array $data)
    {
        return Goal::query()
            ->where(function ($query) use ($data) {
                foreach ($data as $key => $value) {
                    $query->where($key, $value);
                }
            })
            ->with("tasks", "reviews")
            ->first() ?? null;
    }

    public static function allWithPagination(int $paginate = 20)
    {
        return Goal::query()->paginate($paginate);
    }
}
