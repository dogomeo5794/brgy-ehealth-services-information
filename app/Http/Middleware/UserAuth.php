<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Setting;

class UserAuth
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
        $setting = Setting::where('type', 'system-status')->first();
        $data = json_decode($setting->data, true);
        if ($data['system-status']=='Under Mentainance') {
            abort(403, 'System is Under Mentainance!');
        }
        else if ($data['system-status']=='Down') {
            abort(403, 'System temporary DOWN!');
        }
        else if ($data['system-status']=='Disable') {
            abort(403, 'System is temporary Disable by Administrator');
        }
        if (Auth::check() AND Auth::user()->role != 'user') {
            abort(404);
        }
        return $next($request);
    }
}
