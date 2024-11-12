<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comisiones;

class ComisionesController extends Controller
{
    public function workspace(){
        $incompletas = Comisiones::all()->where('is_complete', false);

        return view('espacioTrabajo.index',[
            'coms_incompletas' => $incompletas
        ]);
    }

    public function workspaceComplete(){
        return view('espacioTrabajo.coms-completas');
    }

    public function createComision(){
        return view('espacioTrabajo.create-com');
    }

    public function comisionDetails(){
        return view('espacioTrabajo.coms-detalles');
    }
}
