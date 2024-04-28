<?php

namespace App\Http\Controllers;

use App\Helpers\DB\GoalRepository;
use App\Helpers\Response\GoalResponse;
use App\Http\Requests\Goal\CreateGoalRequest;
use App\Http\Requests\Goal\UpdateGoalRequest;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    use GoalResponse;

    public function show(User $user, Goal $goal)
    {
        dd('nothing');
    }

    public function store(CreateGoalRequest $request, User $user)
    {
        $goal = GoalRepository::create($request);
        return $this->storeResponse($goal);
    }

    public function update(UpdateGoalRequest $request, Goal $goal , User $user)
    {
        [$goal, $isUpdatedFlag] = GoalRepository::update($goal, $request->validated());
        return $this->updateResponse($goal, $isUpdatedFlag);
    }

    public function destroy(Goal $goal)
    {
        $isDeleted = GoalRepository::delete($goal);

        $this->destroyResponse($isDeleted);
    }
}
