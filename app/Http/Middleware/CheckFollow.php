<?php

namespace App\Http\Middleware;

use App\Actions\CheckFollowAction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFollow
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //if (Auth::user()->isAdmin()) {
        //    return $next($request);
        //}

        if (!CheckFollowAction::checkFollow(Auth::user())) {
            dd('not follow');
        }


        return $next($request);
    }
}
