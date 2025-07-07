<?php

namespace App\Http\Requests;
use App\Models\User;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class AuthRules extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required | min: 4 | max: 10',
            'email' => 'required | max:50 | unique:users,email',
            'password'=> 'required | min: 8'
        ];

        if ($this->isMethod('put')) {
            $user = User::findOrFail(auth()->user()->user_id);

            $rules['email'] = ['required', 'max:50', Rule::unique('users')->ignore($user)];

            unset($rules['password']);
        }

        return $rules;
    }

    public function messages(): array{
        return[
            'name.required'     => 'El nombre es requerido.',
            'name.min'          => 'El nombre debe tener un minimo de 4 caracteres.',
            'name.max'          => 'El nombre debe tener un maximo de 10 caracteres.',
            /////////
            'email.required'    => 'El email es requerido.',
            'email.max'         => 'El email debe tener un maximo de 50 caracteres.',
            'email.unique'      => 'El email ya esta registrado.',
            /////////
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña debe tener un mínimo de 8 caracteres.'
        ];
    }
}
