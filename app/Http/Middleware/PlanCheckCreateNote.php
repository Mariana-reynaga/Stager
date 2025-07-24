<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Comissions;

class PlanCheckCreateNote
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $comissions = Comissions::find((int)$request->route('id'));

        $notes = json_decode($comissions->com_notes);

        if ($request->user()->plan_id_fk === 1) {
            return $next($request);
        }else{
            if (count($notes) >= 3) {
                return redirect()->route('espacio.details', ['id'=>$comissions->com_id])->with('tabNum', '3')->with('failure.msg', 'Llegaste al limite de notas para el plan de prueba, elimina una nota o suscribite al plan Premium.');
            }

            return $next($request);
        }
    }
}
