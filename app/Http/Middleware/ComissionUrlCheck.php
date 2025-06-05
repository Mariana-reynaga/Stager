<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Comissions;

class ComissionUrlCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $comision = Comissions::find((int)$request->route('id'));

        // dd($comision->user_id_fk);

        if($comision->user_id_fk === $request->user()->user_id){
            return $next($request);
        }else{
            return redirect()->route('espacio.trabajo', ['user_id' => $request->user()->user_id]);
        }

        return $next($request);
    }
}
