<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
            'id_categoria' =>[
                'required',
                'exists: categorias, id_categoria',
            ],
            'id_cat_marca' =>[
                'required',
                'exists: cat_marcas, id_cat_marca',
            ],
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('productos','codigo')
                    ->ignore($this->route('producto')->id_producto, 'id_producto'),
            ],
            'nombre' => [
                'required',
                'string',
                'max:100',
            ],
            'descripcion' => [
                'required',
                'string',
                'max:255',
            ],
            'contenido' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'unidad_medida' => [
                'required',
                'ln: pz, L, ml, g, kg, oz',
            ],
            'presentacion'=>[
                'required',
                'string',
                'max:50',
            ],
            'estado' => [
                'required',
                'in:Disponible, Agotado',
            ],
        ];
    }
    public function messages():array
    {
        return (new StoreProductoRequest())->messages();
    }
}
