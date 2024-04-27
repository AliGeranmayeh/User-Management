<?php

namespace App\Helpers\Response;

use App\Helpers\Response\MainResponse\ApiResponse;
use Illuminate\Http\Response;


trait UserResponse
{
    use ApiResponse;

    private function indexResponse($users) {
       return $this->successWithData('ok', $users , Response::HTTP_OK);
    }

    private function storeResponse($user) {

    }

    private function updateResponse($user , $data) {

    }

    private function destroyResponse() {

    }

    private function showResponse($user) {

    }
}
