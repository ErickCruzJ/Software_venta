<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
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
            'id_producto' => [
                'required',
                'exists:productos, id_producto',
            ],
            'id_usuario' => [
                'required',
                'exists:usuarios, id_usuario',
            ],
            'cantidad' => [
                'required',
                'integer',
                'min:0',
            ],
            'fecha_hora' => [
                'required', 
                'date',
            ],

        ];
    }
    public function messages(): array
    {
        return[
            'id_producto.required' => 'Debe seleccionar un producto.',
            'id_producto.exists' => 'El producto seleccionado no existe.',

            'id_usuario.required' => 'Debe seleccionar un usuario.',
            'id_usuario.exists' => 'El usuario seleccionado no existe.',

            'cantidad.required' => 'Debe ingresar la cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad no puede ser negativa.',

            'fecha_hora.required' => 'Debe indicar la fecha y hora.',
            'fecha_hora.date' => 'La fecha y hora no son válidas.',
        ];
    }
}
