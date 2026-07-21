<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoriaRequest extends FormRequest
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
                Rule::unique('categorias','nombre')->ignore($this->categoria, 'id_categoria'),
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[\pL0-9\s.,()#%&+\-]*$/u',
            ],
            'estado' => [
                'required',
                'boolean',
            ],
        ];
    }
    public function messages(): array{
        return(new StoreCategoriaRequest())->messages();
    }
}
