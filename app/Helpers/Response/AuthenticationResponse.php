<?php

namespace App\Helpers\Response;

use Illuminate\Http\Response;

trait AuthenticationResponse
{
    private function registerResponse($user)
    {
        return $user ?
            response()->json(['message' => 'Registered successfully'], Response::HTTP_OK) :
            response()->json(['error' => 'Failed to register user'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    private function loginResponse(bool $loggedInFlag)
    {
        return $loggedInFlag ?
            response()->json(
                [
                    'access_token' => auth()->user()->createToken('API Token')->plainTextToken
                ],
                Response::HTTP_OK
            ) :
            response()->json(['error' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);
    }


    private function logoutResponse(bool $loggedOutnFlag)
    {
        return $loggedOutnFlag ?
            response()->json(['message' => 'You have been successfully logged out'], Response::HTTP_OK) :
            response()->json(['error' => 'Failed to logout user'], Response::HTTP_BAD_REQUEST);
    }
}

