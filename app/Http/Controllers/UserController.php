<?php

namespace App\Http\Controllers;

use App\Helpers\DB\UserRepository;
use App\Helpers\Response\UserResponse;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UserResponse;
    public function index()
    {
        $users = UserRepository::allWithPagination();

        return $this->indexResponse($users);
    }

    public function store(CreateUserRequest $request)
    {
        $user = UserRepository::create($request);

        return $this->storeResponse($user);
    }
    public function show(int $id)
    {
        return $this->showResponse(UserRepository::find(['id' => $id]));
    }

    public function destroy(User $user)
    {
        $isDeleted = UserRepository::delete($user);

        $this->destroyResponse($isDeleted);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $this->prepareData($request);
        [$user, $isUpdated] = UserRepository::update($user, $data);

        return $this->updateResponse($user, $isUpdated);
    }

    private function prepareData($data)
    {
        if ($data->has('image')) {
            $imagePath = $data->image;
        }
        $validatedData = $data->validated();

        if ($data->has('image')) {
            $validatedData['image'] = $imagePath;
        }
        return $validatedData;
    }

}
