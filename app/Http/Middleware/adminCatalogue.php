<?php

namespace App\Http\Middleware;

use Closure;

class adminCatalogue
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
        if(!is_null($request->route('admin'))){
            return redirect('catalogue');
        }
        return $next($request);
    }
}
