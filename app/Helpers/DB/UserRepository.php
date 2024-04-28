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
            ->first() ?? null;

    }

    public static function allWithPagination(int $paginate = 10)
    {
        return User::query()->paginate($paginate);
    }

    public static function delete(User $user)
    {
        try {
            $user->delete();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public static function update(User $user, array $data)
    {
        try {
            $user->update($data);
        } catch (\Throwable $th) {
            return [null,false];
        }
        return [$user,true];
    }
}
