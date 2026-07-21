<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCatMarcaRequest extends FormRequest
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
                Rule::unique('cat_marcas','nombre'),
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max: 255',
                'regex:/^[\pL0-9\s.,()#%&+\-]*$/u',
            ],
            'estado'=>[
                'required',
                'boolean',
            ],
        ];
    }
    public function messages():array
    {
        return[
            'nombre.required' => 'El nombre de la marca es obligatorio.',
            'nombre.string' => 'El nombre de la marca debe ser texto.',
            'nombre.max' => 'El nombre no puede exceder los 100 caracteres. ',
            'nombre.unique' => 'Ya existe una marca con ese nombre.',
            'nombre.regex' => 'Contien caracteres inválidos, solo permite letras, números, espacios y guiones. ',

            'descripcion.string' => 'La descripción debe ser texto.' ,
            'descripcion.,max' => 'La descripcion no puede exceder los 255 caracteres.',
            'descripcion.regex' => 'Contiene caracteres invalidos, solo permite letras, números, espacios,puntos, comas, (, ), #, %, &, + y - ',

            'estado.required' => 'Debe indicar el estado.',
            'estado.boolean' => 'El estado es invalido. ', 
        ];
    }
}
