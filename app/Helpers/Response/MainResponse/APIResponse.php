<?php

namespace App\Helpers\Response\MainResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    public function successWithData($message, $data = [], $status = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function success($message, $status = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], $status);
    }

    public function failure($message, $status =Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
