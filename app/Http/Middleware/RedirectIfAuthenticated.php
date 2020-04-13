<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        if(isset($user->role)) {
            switch ($user->role) {
                case'Ученик':
                    return redirect(RouteServiceProvider::STUDENT);
                case'Учитель':
                    return redirect(RouteServiceProvider::STUDENT);
                case'Завуч':
                    return redirect(RouteServiceProvider::STUDENT);
                case'Админ':
                    return redirect(RouteServiceProvider::STUDENT);
            }
        }
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
