<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCaducidadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            ],
            'estado' => [
                'required',
                'in:Disponible, Vencido, Vendido',
            ],
        ];
    }
    public function messages(): array
    {
        return[
            'id_inventario.required' => 'Debe seleccionar un inventario.',
            'id_inventario.exists' => 'El inventario seleccionado no existe.',

            'cantidad_lote_inicial.required' => 'Debe ingresar la cantidad inicial.',
            'cantidad_lote_inicial.numeric' => 'La cantidad inicial debe ser numérica.',
            'cantidad_lote_inicial.min' => 'La cantidad inicial no puede ser negativa.',

            'cantidad_lote_final.required' => 'Debe ingresar la cantidad final.',
            'cantidad_lote_final.numeric' => 'La cantidad final debe ser numérica.',
            'cantidad_lote_final.min' => 'La cantidad final no puede ser negativa.',
            'cantidad_lote_final.lte' => 'La cantidad final no puede ser mayor que la cantidad inicial.',

            'fecha_caducidad.required' => 'Debe ingresar la fecha de caducidad.',
            'fecha_caducidad.date' => 'La fecha de caducidad no es válida.',
            'fecha_caducidad.after' => 'La fecha de caducidad debe ser posterior al día de hoy.',

            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',

            'estado.required' => 'Debe seleccionar el estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
