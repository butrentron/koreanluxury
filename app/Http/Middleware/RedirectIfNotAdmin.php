<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if(!Auth::guard($guard)->check()) {
            $url = $request->url();
            return redirect()->route('admin.login', ['token' => csrf_token(), 'url' => $url]);
        }
        return $next($request);
    }
}
