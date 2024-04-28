<?php

namespace App\Helpers\Response;

use App\Helpers\Response\MainResponse\ApiResponse;
use Illuminate\Http\Response;

trait TaskResponse
{
    use ApiResponse;

    private function storeResponse($task)
    {
        return $task ? $this->successWithData('task has been created', $task, Response::HTTP_CREATED) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function updateResponse($task, bool $isUpdatedFlag)
    {
        return $isUpdatedFlag ? $this->successWithData('task has been updated', $task, Response::HTTP_OK) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function destroyResponse($isDeletedFlag)
    {
        return $isDeletedFlag ? $this->success('task has been deleted successfully') :
            $this->failure("task hasn't been deleted");
    }

    private function showResponse($task)
    {
        return $this->successWithData('ok', $task);
    }
}
