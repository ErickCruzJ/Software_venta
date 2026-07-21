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
        return(new StorePrecioRequest())->messages();
    }
}
