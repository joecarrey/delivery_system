<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdmin
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
        $user = Auth::user()->roles->pluck('name');
        if($user->contains('admin')) {
            return response()->json(['error' => 'Unauthorized', 401]);
        }
        return $next($request);
    }
}
