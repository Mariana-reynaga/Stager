<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{

    public function landingPage(){
        return view('landing');
    }
}
