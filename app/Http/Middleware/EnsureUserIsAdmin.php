<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserIsAdmin
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
        if(!$request->is_admin){
            return redirect()->action('HomeController@loadHomePage');
        }
        return $next($request);
    }
}
