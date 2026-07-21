<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmpleadoRequest extends FormRequest
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
                'regex:/^[\pL\s]+$/u',
            ],
            'apellido_paterno' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\pL]+$/u',
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
                'regex:/^[\pL0-9\s.,#-]+$/u',
            ],
            'numero' => [
                'required',
                'string',
                'max:10',
                'regex:/^[A-Za-z0-9-]+$/u',
            ],
            'codigo_postal'=>[
                'required',
                'regex:/^[0-9]{5}$/u',
            ],
            'colonia' => [
                'required',
                'string', 
                'max:100',
                'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'alcaldia'=>[
                'required',
                'string',
                'max:100',
                'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'ciudad'=> [
                'required',
                'string',
                'max:100',
                'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'telefono'=> [
                'required',
                'regex:/^[0-9]{10}$/u',
            ],
            'correo'=> [
                'required',
                'string',
                'email',
                'max:150',
                Rule::unique('empleados','correo'),
            ],
            'fecha_contratacion' =>[
                'required',
                'date',
                'before_or_equal:today',
            ],
            'foto'=>[
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'estado'=>[
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
    public function messages (): array 
    {
        return[
            'nombre.required' => 'El nombre del empaldo es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letrasy espacios.',

            'apellido_paterno.required' => 'El apellido paterbo del empleado es obligatorio.',
            'apellido_paterno.regex' => 'El apellido paterno debe contener unicamente letras',

            'apellido_materno.regex' => 'El apellido paterno debe contener unicamnete letras',

            'calle.required' => 'La calle es obligatoria',
            'calle.regex' => 'Solo se permiten letras, numero, comas, ., #, -',

            'numero.required' => 'El numero exterior es obligatorio.',
            'numero.regex' => 'Solo puede contenre números, letras y guiones.',

            'codigo_postal.requierd' => 'El código postal es obligatorio.',
            'codigo_postal.digits' => 'El codigo postal debe contener exactamente 5 digitos.',

            'colonia.required' => 'La colonia es obligatoria.',
            'colonia.regex' => 'Solo puede contener letras, números, puntos, guines y espacios.',

            'alcaldia.required' => 'La alcaldia o municipio es obligatorio.',
            'alcaldia.regex' => 'Solo puede contener letras, números, puntos, guines y espacios.',

            'ciudad.required'  => 'La cioudad es obligatoria.',
            'ciudad.regex' => 'Solo puede contener letras, números, puntos, guines y espacios.',

            'telefono.required' => 'El numero de telefono es obligatorio',
            'telefono.digits' => 'El telefono solo puede contener 10 dígitos',
            
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'Ingresa un correo electronico válido.',
            'correo.unique' => 'Este correo ya esta segustrado.',

            'fecha_contratacion.required' => 'La fecha de contratación es obligatoria.',
            'fecha_contratacion.befor_or_equal' => 'La fecha de contratacion no puede ser futura.',

            'foto.image' => 'El archivo seleccionado debe ser una imagen.',
            'foto.max' => 'La imagen no debe de duperar los 2MB.',

            'estado.required' => 'Colar el estdo del empleqado.',
            'estado.in' => 'Seccione un estado válido para el empleado'

        ];
    }
}
