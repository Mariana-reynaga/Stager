<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comisiones;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function loginProcess(Request $req){
        $req->validate(
            [
                'email' => 'required | email:rfc,dns',
                'password' => 'required'
            ],
            [
                'email.required' => 'El email es requerido.',
                'password.required' => 'La contraseña es requerida.'
            ]
        );

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
                'email' => 'required | max:50 | unique:users,email',
                'password'=> 'required | min: 8'
            ],
            [
                'name.required'     => 'El nombre es requerido.',
                'name.min'          => 'El nombre debe tener un minimo de 4 caracteres.',
                'name.max'          => 'El nombre debe tener un maximo de 10 caracteres.',
                /////////
                'email.required'    => 'El email es requerido.',
                'email.max'         => 'El email debe tener un maximo de 50 caracteres.',
                'email.unique'      => 'El email ya esta registrado.',
                /////////
                'password.required' => 'La contraseña es requerida.',
                'password.min' => 'La contraseña debe tener un minimo de 8 caracteres.',
            ]
        );

        $newUser = User::create([
            'name'=>$req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        $creds = $req->only('email', 'password');

        Auth::attempt($creds);

        event(new Registered($newUser));

        $req->session()->regenerate();

        return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
    }

    public function verifyNotice(){
        return view('auth.verify_email_notice');
    }

    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
    }

    public function resendVerify(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function profile(int $user_id){
        $user = User::find($user_id);

        $comision = Comisiones::all()->where('user_id_fk', $user_id );

        return view('perfil.index', [
            "user" => $user,
            "comision" => $comision
        ]);
    }

    public function editProfile(int $user_id){
        $user = User::find($user_id);

        return view('perfil.edit_profile', [
            "user" => $user
        ]);
    }

    public function editUser(int $user_id, Request $req){
        $user = User::findOrFail($user_id);

        $req->validate(
            [
                'name' => 'required | min: 4 | max: 10',
                'email' => ['required', 'max:50', Rule::unique('users')->ignore($user) ]
            ],
            [
                'name.required'     => 'El nombre es requerido.',
                'name.min'          => 'El nombre debe tener un minimo de 4 caracteres.',
                'name.max'          => 'El nombre debe tener un maximo de 10 caracteres.',
                /////////
                'email.required'    => 'El email es requerido.',
                'email.max'         => 'El email debe tener un maximo de 50 caracteres.',
                'email.unique'      => 'El email ya esta registrado.',
            ]
        );

        $input = $req->except('_token', '_method');

        $user->update($input);

        return redirect()->route('user.profile', ['user_id'=>$user_id]);
    }

    public function editPassword(int $user_id, Request $req){
        $user = User::findOrFail($user_id);

        $req->validate(
            [
                'password'=> 'required | min: 8'
            ],
            [
                'password.required' => 'La contraseña es requerida.',
                'password.min' => 'La contraseña debe tener un minimo de 8 caracteres.',
            ]
        );
        
        $user->update(['password'=>Hash::make($req->password)]);

        return redirect()->route('user.profile', ['user_id'=>$user_id]);
    }
}
