<?php

namespace App\Helpers\Response;

use App\Helpers\Response\MainResponse\ApiResponse;
use Illuminate\Http\Response;


trait UserResponse
{
    use ApiResponse;

    private function indexResponse($users)
    {
        return $this->successWithData('ok', $users);
    }

    private function storeResponse($user)
    {
        return $user ? $this->successWithData('user has been created', $user, Response::HTTP_CREATED) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function updateResponse($user, $data)
    {

    }

    private function destroyResponse()
    {

    }

    private function showResponse($user)
    {

    }
}
