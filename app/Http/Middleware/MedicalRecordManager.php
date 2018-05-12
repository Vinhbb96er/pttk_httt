<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MedicalRecordManager
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
        if (Auth::user()->role == config('settings.staff_role.front_desk_staff')) {
            return redirect()->route('404');
        }

        return $next($request);
    }
}
