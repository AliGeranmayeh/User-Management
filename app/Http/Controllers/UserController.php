<?php

namespace App\Http\Controllers;

use App\Helpers\DB\UserRepository;
use App\Helpers\Response\UserResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UserResponse;
    public function index(){
        $users = UserRepository::allWithPagination();

        return $this->indexResponse($users);
    }

    public function store(Request $request){}
    public function show($id){}

    public function destroy($id){}

    public function update(Request $request){}
}
