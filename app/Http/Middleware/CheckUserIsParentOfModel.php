<?php

namespace App\Http\Middleware;

use App\Helpers\DB\UserRepository;
use App\Helpers\Response\MainResponse\ApiResponse;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CheckUserIsParentOfModel
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
        $user = $request->route('user');

        $routeParameters = $request->route()->parameters();

        $secondParameter = collect($routeParameters)->keys()->get(1);

        $model = $routeParameters[$secondParameter];

        if ($model && $user->id !== $model->user_id) {
            return $this->failure('You do not have access to this object', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

}
