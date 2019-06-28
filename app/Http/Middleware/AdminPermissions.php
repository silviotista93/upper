<?php

namespace App\Http\Middleware;

use Closure;

class AdminPermissions
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
        if (auth()->user()->roles[0]->rol == "Admin"){
            return $next($request);
        }else{
            \Auth::logout();
            return back()->with('eliminar', 'No tienes permisos para acceder');
        }
    }
}
