<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $primaryKey = 'id_invenmtario';

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
    public function producto
    {
        return $this->brlongsTo(Produtos::Class, 'id_prosucto');
    }
    public function usuario
    {
        return $this->hasMany(Usuario::Class, 'id_usuario');
    }

}
