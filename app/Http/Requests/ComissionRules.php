<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComissionRules extends FormRequest
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
                'com_title' => 'required | max:20 | min:5',
                'com_description'=>'required | max:150 | min:10',
                'social_fk'=>'required',
                'com_client'=>'required | max:30',
                'com_due'=>'required | after_or_equal:'.now()->format('Y-m-d'),
                'currency_id_fk'=> 'required',
                'com_price' =>'required | integer | min:1',
                'payment_fk'=>'required'
        ];

        if ($this->isMethod('post')) {
            $rules['com_tasks'] = 'required';
        }

        return $rules;
    }

    public function messages(): array{
        return[
                'com_title.required'=>'La comisión necesita un título.',
                'com_title.max'=>'El título debe tener como máximo 20 caracteres.',
                'com_title.min' => 'El título debe tener como minimo 5 caracteres.',
                //
                'com_description.required'=>'La comisión necesita una descripción.',
                'com_description.max'=> 'La descripción debe tener como máximo 150 caracteres.',
                'com_description.min'=> 'La descripción debe tener como minimo 10 caracteres.',
                //
                'social_fk.required'=>'La comisión necesita un método de contacto.',
                //
                'com_client.required'=>'La comisión necesita el usuario del cliente.',
                'com_client.max' => 'El usuario debe tener como máximo 30 caracteres.',
                //
                'com_due.required'=> 'La comisión necesita una fecha de entrega.',
                'com_due.after_or_equal'=> 'La fecha de entrega no puede ser antes de hoy.',
                //
                'currency_id_fk.required'=> 'La comisión necesita una moneda.',
                //
                'com_price.required'=> 'La comisión necesita un precio.',
                'com_price.min'=> 'La comisión no puede costar 0.',
                //
                'payment_fk.required'=>'La comisión necesita un método de pago.',

                'com_tasks.required'=>'Las tareas no pueden estar vacias.'
        ];
    }
}
