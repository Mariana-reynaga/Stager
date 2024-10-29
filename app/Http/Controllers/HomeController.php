<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage(){
        return view('index');
    }

    // public function workSpace(){
    //     return view('workspace.index');
    // }
}
