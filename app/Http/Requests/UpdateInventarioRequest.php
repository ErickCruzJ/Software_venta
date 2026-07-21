<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioRequest extends FormRequest
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
                'exists: usuarios, id_usuario',
            ],
            'cantidad' => [
                'required',
                'integer',
                'min:0',
            ],
            'fecha_hora' => [
                'required',
                'in:Disponible, Agotado',
            ],
        ];
    }
    public function messages():array
    {
        return(new StoreInvetarioRequest())->messages();
    }
}
