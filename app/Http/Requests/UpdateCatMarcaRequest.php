<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCatMarcaRequest extends FormRequest
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
            'nombre' =>[
                'required',
                'string',
                'max: 100',
                Rule::unique(cat_carcas, 'nombre')
                    ->ignore($this->route('catMarca')->id_cat_marca, 'id_cat_marca'),
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:255',
            ],
            'estado'=> [
                'required',
                'boolean',
            ],
        ];
    }
    public function messages(): array
    {
        return[
            'nombre.required' => 'El nombre de la marca es obligatorio.',
            'nombre.string' => 'El nombre de la marca debe ser texto.',
            'nombre.max' => 'El nombre no puede exceder los 100 caracteres.',
            'nombre.unique' => 'Ya existe una marca con ese nombre.',

            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',

            'estado.required' => 'Debe indicar el estado.',
            'estado.boolean' => 'El estado es inválido.',
        ];
    }
}
