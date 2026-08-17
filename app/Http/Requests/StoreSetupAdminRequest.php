<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreSetupAdminRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_usuario' => [
                'required',
                'string',
                'min:4',
                'max:50',
                'regex:/^[\pL0-9#%&\-]+$/u',
                'unique:usuarios,nombre_usuario',
            ],
            'password'=>[
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }
    /**
     * Mensajes personalizados de validación.
     */

    public function messages(): array
    {
        return[
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'nombre_usuario.unique' => 'Ese nombre de usuario ya está registrado.',
            'nombre_usuario.min' => 'Debe contener al menos 4 caracteres',
            'nombre_usuario.max' => 'No puede superar los 50 caracteres',
            'nombre_usuario.regex' => 'Contiene caracteres invalidos. Solo se permite letras, números, #, %, & y -.',

            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }
}
