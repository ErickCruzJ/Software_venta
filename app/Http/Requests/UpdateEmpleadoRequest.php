<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
usE Illuminate\Validation\Rule;

class UpdateEmpleadoRequest extends FormRequest
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
            'nombre' => [
                'required',
                'string',
                'max:100',
                'regex: /^[\pL\s]+$/u',
            ],
            'apellido_paterni'=>[
                'required',
                'string',
                'max:50',
                'regex: /^[\pL]+$/u',
            ],
            'apellido_materno'=>[
                'nullable',
                'string',
                'max:50',
                'regex:/^[\pL]+$/u',
            ],
            'calle' =>[
                'required',
                'string',
                'max:100',
                'regex: /^[ A-Za-z0-9-]+/u',
            ],
            'numero'=>[
                'required',
                'string',
                'max:10',
                'regex: /^[ A-Za-z0-9-]+/u',
            ],
            'codigo_postal' => [
                'required',
                'regex: /^[0-9]{5}',
            ],
            'colonia' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'alcaldia' =>[
                'required',
                'strign',
                'max:100',
                'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'ciudad' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'telefono' =>[
                'required',
                'regex:/^[0-9]{10}$/u',
            ],
            'correo' => [
                'required',
                'string',
                'email',
                'max:150',
                Rule::unique('empleado','correo')
                    ->ignore($this->route('empleado')->id_empleadio, 'id_empleado'),
            ],
            'fecha_contratacion' => [
                'required',
                'date',
                'before_or_equal:today',
            ],
            'foto' =>[
                'nullable',
                'image',
                'mimes: jps,jpeg,png,webp', 
                'max:2048',
            ],
            'estado' => [
                'required',
                Rule::in([
                    'Activo',
                    'Suspendido',
                    'Vacaciones',
                    'Baja temporal',
                    'Baja',
                ]),
            ],
        ];
    }
    public function messages():array
    {
        return (new StoreEmpleadoRequest())->messages();
    }
}
