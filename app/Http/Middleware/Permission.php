<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
      if(auth()->user())
      {
          if (!User::hasRole($role))
          {
              // return $next($request);
              return redirect('/');
          }else{

              return $next($request);
          }
      }
    }
}
