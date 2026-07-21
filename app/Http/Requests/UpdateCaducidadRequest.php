<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCaducidadRequest extends FormRequest
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
            'id_inventario' => [
                'required',
                'exists:inventarios, id_inventario',
            ],
            'cantidad_lote_inicial' => [
                'required',
                'numeric',
                'min:0',
            ],
            'cantidad_lote_final' => [
                'required',
                'numeric',
                'min:0',
                'lte:cantidad_lote_inicial',
            ],
            'fecha_caducidad' => [
                'required',
                'date',
                'after:today',
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[\pL0-9\s,.()#%&+\-]*$/u',
            ],
            'estado' => [
                'required',
                Rule::in([
                    'Disponible', 
                    'Vencido', 
                    'Vendido',
                ]),
            ],
        ];
    }
    public function messages(): array
    {
        return(new StoreCaducidadRequest())->messages();
    }
}
