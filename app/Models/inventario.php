<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventario extends Model
{
    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'id_producto',
        'id_usuario',
        'cantidad',
        'fecha_hora',
        'estado',
    ];

    protected function casts(): array
    {
        return[
            'fecha_hora'=> 'dateTime'
        ];
    }
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
    public function usuario (): BelongsTo
    {
        return $this->belongsTo(Usuario::Class, 'id_usuario');
    }
    public function caducidad():HasMany
    {
        return $this->hasMany(Caducidad::class, 'id_inventario');
    }

}
