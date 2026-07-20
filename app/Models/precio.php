<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Precio extends Model
{
    protected $primaryKey = 'id_precio';

    protected $fillable = [
        'id_producto',
        'precio_venta',
        'fecha',
        'estado',
    ];
    
    public function casts():array
    {
        return[
            'fecha' => 'date',
            'estado' => 'boolean',
        ];
    }

    public function producto(): BelongsTo
    {
        return $this->belonsTo(Producto::Class, 'id_producto');
    }
}
