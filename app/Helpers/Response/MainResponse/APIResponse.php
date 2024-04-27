<?php

namespace App\Helpers\Response\MainResponse;


trait ApiResponse
{
    public function successWithData($message, $data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function success($message, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], $status);
    }

    public function failure($message, $status = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
