<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRules extends FormRequest
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
        return [
            'title' => 'required | max:30 | min:5',
            'note'  => 'required | max:300'
        ];
    }

    public function messages(): array{
        return[
            'title.required' => 'El título es requerido.',
                'title.max' => 'El título debe tener como maximo 30 caracteres.',
                'title.min' => 'El título debe tener como minimo 5 caracteres.',
                //////////
                'note.required'=>'La nota es requerida.',
                'note.max' => 'La nota debe tener como maximo 300 caracteres.'
        ];
    }
}
