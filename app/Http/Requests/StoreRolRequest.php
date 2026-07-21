<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreRolRequest extends FormRequest
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
                'regex:/^[\pL0-9\s]+$/u',
                Rule::unique('roles', 'nombre'),
            ],
            'descripcion' => [
                'required',
                'string',
                'max:255',
                'regex: /^[\pL0-9\s.,()#%&+\-]+$/u',
            ],
            'estado' => [
                'required',
                'boolean',
            ],
        ];
    }
    public function messages(): array
    {
        return[
            'nombre.required' => 'El nombre del rol es obligatorio.',
            'nombre.unique' => 'Ya existe un rol con ese nombre.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'nombre.regex' => 'Contien caracteres inválidos, solo permite letras, números y espacios ',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede superar los 255 caracteres.',
            'descripcion.regex' => 'Contiene caracteres invalidos, solo permite letras, números, espacios,puntos, comas, (, ), #, %, &, + y - ',

            'estado.required' => 'Debe indicar el estado.',
            'estado.boolean' => 'El estado no es válido.',
        ];
    }
}
