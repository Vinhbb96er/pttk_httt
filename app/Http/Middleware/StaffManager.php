<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StaffManager
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

        if (!in_array(Auth::user()->role, [
            config('settings.staff_role.super_admin'),
            config('settings.staff_role.admin'),
        ])) {
            return redirect()->route('404');
        }

        return $next($request);
    }
}
