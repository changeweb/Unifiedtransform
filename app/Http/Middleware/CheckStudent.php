<?php

namespace App\Http\Middleware;

use Closure;

class CheckStudent
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
      if (\Auth::user()->role == 'student' || \Auth::user()->role == 'admin') {
          return $next($request);
      }
      return redirect('home');
    }
}
