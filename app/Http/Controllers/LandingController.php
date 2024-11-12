<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landingPage(){
        return view('landing');
    }

    public function perfilTemp(){
        return view('perfil.index');
    }
}
