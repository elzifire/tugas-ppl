<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       // Check if the user is authenticated and their role is not 'admin'
       if ($request->user() && $request->user()->role->role_name !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

        return $next($request);
    }
}
