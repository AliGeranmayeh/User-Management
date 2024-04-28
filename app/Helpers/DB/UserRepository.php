<?php


namespace App\Helpers\DB;

use App\Helpers\Enums\RoleType;
use App\Models\User;

class UserRepository
{

    public static function create($data)
    {
        return User::create([
            "name" => $data->name,
            "email" => $data->email,
            "password" => $data->password,
            "personal_code" => $data->personal_code,
            "image" => $data->image,
            "role_id" => RoleType::EMPLOYEE,
        ]) ?? null;
    }

    public static function find(array $data)
    {

        return User::query()
            ->where(function ($query) use ($data) {
                foreach ($data as $key => $value) {
                    $query->where($key, $value);
                }
            })
            ->with("goals,tasks")
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
            return [null, false];
        }
        return [$user, true];
    }

    public static function userWithGoals(User $user)
    {
        return $user->with('goals')->get();
    }

    private static function saveImage(string $image)
    {

    }
}
