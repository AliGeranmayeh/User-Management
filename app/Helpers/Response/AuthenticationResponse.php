<?php

namespace App\Helpers\Response;

use App\Helpers\Response\MainResponse\ApiResponse;
use Illuminate\Http\Response;

trait AuthenticationResponse
{
    use ApiResponse;

    // private function registerResponse($user)
    // {
    //     return $user ?
    //         $this->success('Registered successfully', Response::HTTP_OK) :
    //         $this->failure('Failed to register user', Response::HTTP_INTERNAL_SERVER_ERROR);
    // }


    private function loginResponse(bool $loggedInFlag)
    {
        return $loggedInFlag ?
            $this->successWithData(
                'Ok',
                [
                    'access_token' => auth()->user()->createToken('API Token')->plainTextToken
                ]
            ) :
            $this->failure('Invalid Credentials', Response::HTTP_UNAUTHORIZED);
    }


    private function logoutResponse(bool $loggedOutnFlag)
    {
        return $loggedOutnFlag ?
            $this->success('You have been successfully logged out') :
            $this->failure('Failed to logout user', Response::HTTP_BAD_REQUEST);
    }
}
