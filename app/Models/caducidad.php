<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caducidad extends Model
{
    protected $primaryKey = "id_caducidad";

    protected $fillable = [
        'id_inventario',
        'cantidad_lote_inicial',
        'cantidad_lote_final',
        'fecha_caducidad',
        'descripcion',
        'estado',
    ];

    protected function casts():array
    {
        return[
            'fecha_caducidad'=>'date',
        ];
    }
    public function inventario():BelongsTo
    {
        return $this->belongsTo(Inventario::class, 'id_inventario');
    }
}
