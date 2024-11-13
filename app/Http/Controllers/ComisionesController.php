<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comisiones;
use App\Models\MetodoPago;
use App\Models\RedesSociales;

class ComisionesController extends Controller
{
    public function workspace(){
        $incompletas = Comisiones::all()->where('is_complete', false);

        return view('espacioTrabajo.index',[
            'coms_incompletas' => $incompletas
        ]);
    }

    public function workspaceComplete(){
        $completas = Comisiones::all()->where('is_complete', true);

        return view('espacioTrabajo.coms-completas', [
            'coms_completas' => $completas
        ]);
    }

    public function comisionDetail(int $id){
        $comision_dets = Comisiones::find($id);

        return view('espacioTrabajo.coms-detalles', [
            'comision'=> $comision_dets
        ]);
    }

    public function createComision(){
        $redes_sociales = RedesSociales::all();
        $metodos_pagos = MetodoPago::all();

        return view('espacioTrabajo.create-com',[
            'redes_sociales'=> $redes_sociales,
            'metodos_pagos' => $metodos_pagos
        ]);
    }

    public function comisionDetails(){
        return view('espacioTrabajo.coms-detalles');
    }
}
