<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comissions;
use App\Models\Plans;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\AuthRules;
use App\Http\Requests\ImageRules;

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
                ->withInput()
                ->withErrors(['wrongpass'=>'La contraseña no es correcta.']);
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

    public function registerProcess(AuthRules $req) {
        $newUser = User::create([
            'name'=>$req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        $creds = $req->only('email', 'password');

        Auth::attempt($creds);

        return redirect()->route('plan_select.index');
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

        $comision = Comissions::all()->where('user_id_fk', $user_id );

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

    public function editUser(int $user_id, AuthRules $req){
        $user = User::findOrFail($user_id);

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

    public function editImage(int $user_id, ImageRules $req){

        $user = User::findOrFail($user_id);

        $pfp = $req->user_image;

        if($user->user_image != null){

            $oldImage = $user->user_image;
            Storage::disk('public')->delete($oldImage);
        }

        $path = $pfp->store('users', 'public');

        $user->update(['user_image' => $path]);

        return redirect()->route('user.profile', ['user_id'=>$user_id]);
    }
}
