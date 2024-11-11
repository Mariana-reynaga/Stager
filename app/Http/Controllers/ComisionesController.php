<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComisionesController extends Controller
{
    public function workspace(){
        return view('espacioTrabajo.index');
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
