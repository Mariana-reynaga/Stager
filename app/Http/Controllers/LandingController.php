<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{

    public function landingPage(){
        // $date = date_create(date('d/m/Y'));

        // date_modify($date, '+1 day');

        // dd(date_format($date, 'd/m/Y'));

        return view('landing');
    }
}
