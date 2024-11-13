<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function loginProcess(Request $req){
        $credentials = $req->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return redirect()
            ->back(fallback: route('auth.login.form'))
            ->withInput();
        }

        return redirect()
        ->route('espacio.trabajo');
    }

    public function logoutProcess(Request $req){
        auth()->logout();

        $req ->session()->invalidate();
        $req ->session()->regenerateToken();

        return redirect()
            ->route('landing.page');
    }

    public function registerForm(){
        return view('auth.registrar');
    }
}
