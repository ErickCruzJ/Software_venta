<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductoRequest extends FormRequest
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
            'id_categoria'=>[
                'required',
                'exists: categorias, id_categoria',
            ],
            'id_cat_marca' =>[
                'required',
                'exists: cat_marca, id_cat_marca'
            ],
            'codigo'=>[
                'required',
                'string',
                'max:50',
                'regex:/^[\pL0-9\s.-]+$/u',
                Rule::unique('producto','codigo'),
            ],
            'nombre' => [
              'required',
              'string',
              'max:50',
              'regex:/^[\pL0-9\s.-]+$/u',
            ],
            'descripcion'=> [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL0-9\s.,()#%&+\-]+$/u',
            ]
            'contenido' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'unidad_medida' => [
                'required',
                Rule::in ([
                    'pz',
                    'L', 
                    'ml', 
                    'g', 
                    'kg', 
                    'oz',
                ]),
            ],
            'presentacion' => [
                'requuired',
                'string',
                'max:50',
                'regex:/^[\pL0-9\s.,()#%&+\-]+$/u',
            ],
            'estado' => [
                'required ',
                Rule::in ([
                    'Disponible', 
                    'Agotado',
                ]),
            ],
        ];
    }
    public function messange():array
    {
        return[
            'id_categoria.required' => 'Debe seleccionar una categoría.',
            'id_categoria.exists' => 'La categoría seleccionada no existe.',

            'id_cat_marca.required' => 'Debe seleccionar una marca.',
            'id_cat_marca.exists' => 'La marca seleccionada no existe.',

            'codigo.required' => 'El código del producto es obligatorio.',
            'codigo.unique' => 'Ya existe un producto con ese código.',
            'codigo.max' => 'El código no puede exceder los 50 caracteres.',
            'codigo.regex' => 'Contiene caracteres inválidos, solo permite letras, números, espacios, puntos y guiones. ',

            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder los 100 caracteres.',
            'nombre.regex' => 'Contiene caracteres inválidos, solo permite letras, números, espacios, puntos y guiones. ',

            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',
            'descripcion.regex' => 'Contiene caracteres invalidos, solo permite letras, números, espacios,puntos, comas, (, ), #, %, &, + y - ',

            'contenido.required' => 'Debe indicar el contenido.',
            'contenido.numeric' => 'El contenido debe ser numérico.',
            'contenido.gt' => 'El contenido debe ser mayor que cero.',

            'unidad_medida.required' => 'Debe seleccionar una unidad de medida.',
            'unidad_medida.in' => 'La unidad de medida es inválida.',

            'presentacion.required' => 'La presentación es obligatoria.',
            'presentacion.max' => 'La presentación no puede exceder los 50 caracteres.',

            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
