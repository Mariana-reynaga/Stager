<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landingPage(){
        return view('landing');
    }

    public function workPageTemp(){
        return view('espacioTrabajo.index');
    }

    public function workPageCompleteTemp(){
        return view('espacioTrabajo.coms-completas');
    }

    public function createComTemp(){
        return view('espacioTrabajo.create-com');
    }

    public function perfilTemp(){
        return view('perfil.index');
    }
}
