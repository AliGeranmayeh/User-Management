<?php


namespace App\Helpers\DB;

use App\Helpers\Enums\RoleType;
use App\Models\Question;
use App\Models\QuestionBank;

class QuestionRepository
{

    public static function create($data)
    {
        return QuestionBank::create([
            "question" => $data->question,
        ]) ?? null;
    }

    public static function find(array $data)
    {
        return QuestionBank::query()
            ->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->where($key, $value);
            }
        })
            ->first() ?? null;
    }

    public static function allWithPagination(int $paginate = 10)
    {
        return QuestionBank::query()->paginate($paginate);
    }

    public static function delete(QuestionBank $question)
    {
        try {
            $question->delete();
        }
        catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public static function update(QuestionBank $question, array $data)
    {
        try {
            $question->update($data);
        }
        catch (\Throwable $th) {
            return [null, false];
        }
        return [$question, true];
    }
}
