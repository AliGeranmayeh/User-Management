<?php


namespace App\Helpers\DB;

use App\Models\User;

class UserRepository
{

    public static function create(array $data)
    {
        return User::create($data) ?? null;
    }

    public static function find(array $data)
    {

        return User::query()
            ->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->where($key, $value);
            }
        })
            ->first()??null;

    }
}
