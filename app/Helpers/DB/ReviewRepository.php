<?php

namespace App\Helpers\DB;

use App\Models\Review;


class ReviewRepository
{

    public static function create($data)
    {
        return Review::create([
            'question' => $data->question,
            'description' => $data->description,
            'goal_id' => $data->goal_id,
            "result_point" => $data->result_point,
            "result_quality" => $data->result_quality,
        ]) ?? null;
    }

    public static function update(Review $review, array $data)
    {
        try {
            $review->update($data);
        }
        catch (\Throwable $th) {
            return [null, false];
        }
        return [$review, true];
    }

    public static function delete(Review $review)
    {
        try {
            $review->delete();
        }
        catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
