<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
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
                'exists: empleados, id_empleado', 
            ],
            'id_rol' => [
                'required',
                'exists: roles, id_rol',
            ],
            'nombre_usuario' => [
                'required',
                'string',
                'min: 4',
                'max: 50', 
                Rule::unique('unique', 'nombre_usuario')
                    ->ignore($this->route('usuario')->id_usuario, 'id_usuario'),
            ],
            'password' => [
                'nullable', 
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
            'estado' => [
                'required',
                'in: Conectado, Desconectado, Bloqueado, Suspendido',
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

            'password.confirmed' => 'Las contraseñas no coinciden.',

            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
