<?php

namespace App\Http\Middleware;

use Closure;

class CheckTeacher
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
      if (\Auth::user()->role == 'teacher' || \Auth::user()->role == 'admin') {
          return $next($request);
      }
      return redirect('home');
    }
}
