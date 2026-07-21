<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUsuarioRequest extends FormRequest
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
            'id_empleado' => [
                'required',
                'exists: empelados, id_empleado',
            ],
            'id_rol' => [
                'required',
                'exists:role,id_rol',
            ],
            'nombre_usuario' => [
                'required',
                'string',
                'min: 4',
                'max: 50',
                'regex:/^[\pL0-9#%&\-]+$/u',
                Rule::unique('usuarios','nombre_usuario'),
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
            'estado' =>[
                'required',
                Rule::in([
                    'Conecatado',
                    'Desconecatdo', 
                    'Bloqueado', 
                    'Suspendido',
                ]),
            ],
        ];
    }
    public function messages():array
    {
        return[
            'id_empleado.required' => 'Debe seleccionar un empleado.',
            'id_empleado.exists' => 'El empleado seleccionado no existe.',

            'id_rol.required' => 'Debe seleccionar un rol.',
            'id_rol.exists' => 'El rol seleccionado no existe.',

            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'nombre_usuario.unique' => 'Ese nombre de usuario ya está registrado.',
            'nombre_usuario.min' => 'Debe contener al menos 4 caracteres.',
            'nombre_usuario.max' => 'No puede superar los 50 caracteres.',
            'nombre_usuario.regex' => 'Contien caracteres inválidos, solo permite letras, números, #, %, &',

            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
