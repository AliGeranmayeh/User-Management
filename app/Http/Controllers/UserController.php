<?php

namespace App\Http\Controllers;

use App\Helpers\DB\UserRepository;
use App\Helpers\Response\UserResponse;
use App\Http\Requests\Users\CreateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UserResponse;
    public function index(){
        $users = UserRepository::allWithPagination();

        return $this->indexResponse($users);
    }

    public function store(CreateUserRequest $request){
        $user = UserRepository::create($request->validated());

        return $this->storeResponse($user);
    }
    public function show($id){}

    public function destroy($id){}

    public function update(Request $request){}
}
