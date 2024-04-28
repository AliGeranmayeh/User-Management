<?php

namespace App\Helpers\Response;

use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Response\MainResponse\ApiResponse;


trait ReviewResponse
{
    use ApiResponse;

    private function storeResponse($review)
    {
        return $review ? $this->successWithData('review has been created', $review, Response::HTTP_CREATED) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function updateResponse($review, bool $isUpdatedFlag)
    {
        return $isUpdatedFlag ? $this->successWithData('review has been updated', $review, Response::HTTP_OK) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function destroyResponse($isDeletedFlag)
    {
        return $isDeletedFlag ? $this->success('review has been deleted successfully') :
            $this->failure("review hasn't been deleted");
    }

    private function showResponse($review)
    {
        return $this->successWithData('ok', $review);
    }
}
