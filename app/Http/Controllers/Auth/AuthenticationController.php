<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Helpers\DB\UserRepository;
use App\Helpers\Response\AuthenticationResponse;
use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use AuthenticationResponse;

    // public function register(RegisterRequest $request)
    // {

    //     $user = UserRepository::create($request->validated());

    //     return $this->registerResponse($user);
    // }

    public function login(LoginRequest $request)
    {
        $isLoggedIn = $this->checkLoginCredentials($request->validated());

        return $this->loginResponse($isLoggedIn);
    }

    public function logout()
    {
        $isLoggedOut = $this->performeLogout();

        return $this->logoutResponse($isLoggedOut);
    }


    private function checkLoginCredentials(array $loginData)
    {
        return Auth::attempt($loginData);
    }


    private function performeLogout()
    {
        try {
            auth()->user()->tokens()->delete();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
