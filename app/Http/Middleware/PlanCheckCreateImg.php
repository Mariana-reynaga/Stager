<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use App\Models\Comissions;
use App\Models\Gallery;

class PlanCheckCreateImg
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $comissions = Comissions::find((int)$request->route('id'));

        $gallery_imgs = Gallery::all()->where('com_id_fk', (int)$request->route('id'));

        if ($request->user()->plan_id_fk === 1) {
            return $next($request);
        }else{
            if (count($gallery_imgs) >= 3) {
                return redirect()->route('espacio.details', ['id'=>$comissions->com_id])->with('tabNum', '4')->with('failure.msg', 'No hay más imagenes disponibles, elimine una o suscribase al plan Premium.');
            }

            return $next($request);
        }
    }
}
