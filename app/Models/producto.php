<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Cat_marca::Class, 'id_cat_marca'); 
    }

    public function categoria():BelongsTo
    {
        return $this->belongsTo(Categoria::Class, 'id_categoria');
    }

    public function precio():HasOne
    {
        return $this->hasOne(Precio::class, 'id_producto');
    }

    public function inventario(): HasOne
    {
        return $this->hasOne(Inventario::Class, 'id_producto');
    }
}
