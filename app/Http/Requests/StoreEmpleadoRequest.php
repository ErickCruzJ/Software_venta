<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
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
                'regex:/^[\pL\s]+$/u',
            ],
            'apellido_paterno' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\pL\s]+$/u',
            ],
            'apellido_materno'=>[
                'nullable',
                'string',
                'max:50',
                'regex: /^[\pL\s]+$/u',
            ],
            'calle' =>[
                'required',
                'string',
                'max:100',
                'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'numero' => [
                'required',
                'string',
                'max:10',
                'regex:/^[A-Za-z0-9-]+$/',
            ],
            'CP'
            'colonia' => [

            ]
        ];
    }
}
