<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionCheckAjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ($request->ajax() && \Auth::guest()) {
        //     return response()->json(['message' => 'Session Expired'], 403);
        // }

        // if (Auth::check()) {
        if ($request->ajax() AND !Auth::check()) {
            return response()->json([
                'message' => 'not login',
            ]);
        }

        return $next($request);

    }
}
