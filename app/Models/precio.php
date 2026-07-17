<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    protected $primaryKey = 'id_precio';

    protected $fillable = [
        'id_producto',
        'precio_venta',
        'fecha',
        'estado',
    ]
    
    publuc function casts():array
    {
        return[
            'fecha' => 'date',
            'estado' => 'boolean',
        ];
    }

    public function producto
    {
        return $this->belonTo(Producto::Class, 'id_producto');
    }
}
