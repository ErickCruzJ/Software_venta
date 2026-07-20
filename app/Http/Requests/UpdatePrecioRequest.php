<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrecioRequest extends FormRequest
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
            'precio_venta' =>[
                'required',
                'numeric',
                'min: 0.01',
            ],
            'fecha' =>[
                'required',
                'date',
            ],
            'estado' => [
                'required',
                'boolean',
            ],
        ];
    }
    public function messages():array
    {
        return[
            'id_producto.required' => 'Debe seleccionar un producto.',
            'id_producto.exists' => 'El producto seleccionado no existe.',

            'precio_venta.required' => 'El precio de venta es obligatorio.',
            'precio_venta.numeric' => 'El precio debe ser un valor numérico.',
            'precio_venta.min' => 'El precio debe ser mayor que cero.',

            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no es válida.',

            'estado.required' => 'Debe indicar el estado.',
            'estado.boolean' => 'El estado es inválido.',
        ];
    }
}
