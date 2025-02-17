<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function loginProcess(Request $req){
        $credentials = $req->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return redirect()
                   ->back(fallback: route('login'))
                   ->withInput();
        }else{

            return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
        }
    }

    public function logoutProcess(Request $req){
        auth()->logout();

        $req ->session()->invalidate();
        $req ->session()->regenerateToken();

        return redirect()
            ->route('landing.page');
    }

    public function registerForm(){
        return view('auth.register');
    }

    public function registerProcess(Request $req) {
        $req->validate(
            [
                'name' => 'required | min: 4 | max: 10',
                'email' => 'required | max:50 |unique:users,email',
                'password'=> 'required | min: 8'
            ]
        );

        $newUser = User::create([
            'name'=>$req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        $creds = $req->only('email', 'password');

        Auth::attempt($creds);
        $req->session()->regenerate();
        return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
    }

    public function profile(int $user_id){
        $user = User::find($user_id);

        return view('perfil.index', [
            "user" => $user
        ]);
    }
}
