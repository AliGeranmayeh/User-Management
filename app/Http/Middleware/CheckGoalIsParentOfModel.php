<?php

namespace App\Http\Middleware;

use App\Helpers\DB\GoalRepository;
use App\Helpers\Response\MainResponse\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGoalIsParentOfModel
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $goal = GoalRepository::find(['id' => $request->route('goal')]);

        $routeParameters = $request->route()->parameters();

        $secondParameter = collect($routeParameters)->keys()->get(1);

        $model = $this->findOrFail($secondParameter, $routeParameters[$secondParameter]);

        if (is_null($goal)) {
            return $this->failure('Invalid User', Response::HTTP_NOT_FOUND);
        }

        if ($model && $goal->id !== $model->goal_id) {
            return $this->failure('You do not have access to this object', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    private function findOrFail($modelName , $id)
    {
        $model = "App\\Models\\$modelName";

        return $model::findOrFail($id);
    }
}
