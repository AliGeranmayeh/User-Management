<?php

namespace App\Helpers\Response;

use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Response\MainResponse\ApiResponse;


trait QuestionResponse
{
    use ApiResponse;

    private function indexResponse($questions)
    {
        return $this->successWithData('ok', $questions);
    }

    private function storeResponse($question)
    {
        return $question ? $this->successWithData('question has been created', $question, Response::HTTP_CREATED) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function updateResponse($question, bool $isUpdatedFlag)
    {
        return $isUpdatedFlag ? $this->successWithData('question has been updated', $question, Response::HTTP_OK) :
            $this->failure('something went wrong', Response::HTTP_BAD_REQUEST);
    }

    private function destroyResponse($isDeletedFlag)
    {
        return $isDeletedFlag ? $this->success('question has been deleted successfully') :
            $this->failure("question hasn't been deleted");
    }

    private function showResponse($question)
    {
        return $this->successWithData('ok', $question);
    }
}
