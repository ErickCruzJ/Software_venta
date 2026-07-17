<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_categoria',
        'id_cat_marca',
        'codigo',
        'nombre',
        'descripcion',
        'contenido', 
        'unidad_medida',
        'presentacion',
        'estado',
    ];
    
    public function cat_categoria
    {
        return $this->belongsTo(Cat_marca::Class, 'id_cat_marca'); 
    }

    public function categoria
    {
        return $this->belongsTo(Categoria::Class, 'id_categoria');
    }

    public function precio
    {
        return $this->hasOne(Precio::class, 'id_precio');
    }

    public function inventario
    {
        return $this->hasOne(Inventario::Class, 'id_inventario');
    }
}
