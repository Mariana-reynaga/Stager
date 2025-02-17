<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserUrlCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->user_id === (int)$request->route('user_id')) {
            return $next($request);
        }else{
            return redirect()->route('espacio.trabajo', ['user_id' => $request->user()->user_id]);
        }
    }
}
