<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoriaRequest extends FormRequest
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
                'regex:/^[\pL0-9\s-]+$/u',
                Rule::unique('categorias','nombre'),
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[\pL0-9\s.,()#%&+\-]*$/u',
            ],
            'estado' => [
                'required',
                'boolean'
            ],
        ];
    }
    public function messages(): array
    {
        return[
            'nombre.required' => 'El nombre de la categoria es obligatorio.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'nombre.regex' => 'Contien caracteres inválidos, solo permite letras, números, espacios y guiones. ',
            'nombre.unique' =>  'Ya existe una categoria con este nombre. ',
            'descripcion.max' => 'La descripcion no puede superar los 255 carateres.',
            'descripcion.regex' => 'Contiene caracteres invalidos, solo permite letras, números, espacios,puntos, comas, (, ), #, %, &, + y - ',
            'estado.required' => 'El estado es obligatorio. ',
            'estado.boolean' => 'El estado seleccionado no es válido. ',
        ];
    }
}
