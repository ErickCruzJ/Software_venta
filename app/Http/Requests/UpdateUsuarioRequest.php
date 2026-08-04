<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

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
                'nullable',
                'exists:empleados,id_empleado', 
                Rule::unique('usuarios','id_empleado')
                ->ignore(
                    $this->route('usuario')->id_usuario,
                    'id_usuario'
                ),
            ],
            'id_rol' => [
                'required',
                'exists:roles,id_rol',
            ],
            'nombre_usuario' => [
                'required',
                'string',
                'min:4',
                'max:50', 
                'regex:/^[\pL0-9#%&\-]+$/u',
                Rule::unique('usuarios', 'nombre_usuario')
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
        ];
    }
    public function messages():array
    {
        return (new StoreUsuarioRequest())->messages();
    }
}
