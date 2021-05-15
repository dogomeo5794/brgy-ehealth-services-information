<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = User::where('role', 'admin');
        $userCount = $user->count();
        $user = $user->first();
        // dd($user->fullname==null);
        if (Auth::guard($guard)->check()) {
            // return redirect()->route('user.base');
            if (Auth::user()->role=='admin') {
                return redirect()->route('admin.dashboard');
            }
            else {
                return redirect()->route('user.dashboard');
            }
        }
        else if ( $userCount == 0 OR ($userCount==1 AND $user->fullname==null) ) {
            return redirect()->route('app.started');
        }
        return $next($request);

        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        // return $next($request);
    }
}
