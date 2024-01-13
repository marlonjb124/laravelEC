<?php

namespace App\Http\Middleware;


use Closure;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->rol === "admin") {
            return $next($request);
        }
        else{
            return response()->json(["message"=>'Acceso denegado.']);
        }
        
    }
}