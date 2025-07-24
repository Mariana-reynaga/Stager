<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ImageRules extends FormRequest
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
            'pic_route' => 'required',
            'pic_route.*'=>'mimes:png,jpg,jpeg | max:2048'
        ];
        
        $routeName = Route::currentRouteName();

        if ($routeName === 'reciept.upload.process') {
            $rules = [
                'com_reciept' => 'required',
                'com_reciept.*'=>'mimes:pdf,jpg,png | max:2048'
            ];

        } elseif($routeName === 'user.image.edit') {
            $rules = [
                'user_image' => 'required',
                'user_image.*'=>'mimes:png,jpg,jpeg | max:2048'
            ];
        }

        return $rules;
    }

    public function messages(): array{
        $routeName = Route::currentRouteName();

        $message = [
            'pic_route.required'=>'La imagen es requerida.',
            'pic_route.*.mimes'=>'La imagen debe ser de tipo png, jpg o jpeg.',
            'pic_route.*.max'=>'La imagen debe ser como maximo 2MB.'
        ];

        if ($routeName === 'reciept.upload.process') {
            $message = [
                'com_reciept.required'=>'El recibo es requerido.',
                'com_reciept.*.mimes'=>'El recibo debe ser de tipo pdf, png o jpg.',
                'com_reciept.*.max'=>'El recibo debe ser como maximo 2MB.'
            ];

        } elseif($routeName === 'user.image.edit') {
            $message = [
                'user_image.required'=>'La imagen es requerida.',
                'user_image.*.mimes'=>'La imagen debe ser de tipo png, jpg o jpeg.',
                'user_image.*.max'=>'La imagen debe ser como maximo 2MB.'
            ];
        }

        return $message;
    }
}
