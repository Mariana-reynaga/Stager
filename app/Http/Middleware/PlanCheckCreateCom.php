<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Comissions;

class PlanCheckCreateCom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $comissions = Comissions::all()->where('user_id_fk', $request->user()->user_id )->where('is_complete', false);

        if ($request->user()->plan === 'premium') {
            return $next($request);
        }else{
            if (count($comissions) >= 3) {
                return redirect()->route('espacio.trabajo', ['user_id' => $request->user()->user_id])->with('feedback', true);
            }

            return $next($request);
        }
    }
}
