<?php

namespace App\Helpers\Response;

use App\Helpers\Response\MainResponse\ApiResponse;
use Illuminate\Http\Response;


trait GoalResponse
{
    use ApiResponse;

    private function storeResponse($goal)
    {
        return $goal ? $this->successWithData('goal has been created', $goal, Response::HTTP_CREATED) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function updateResponse($goal, bool $isUpdatedFlag)
    {
        return $isUpdatedFlag ? $this->successWithData('goal has been updated', $goal, Response::HTTP_OK) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function destroyResponse($isDeletedFlag)
    {
        return $isDeletedFlag ? $this->success('goal has been deleted successfully') :
            $this->failure("goal hasn't been deleted");
    }

    private function showResponse($goal)
    {
        return $this->successWithData('ok', $goal);
    }
}
