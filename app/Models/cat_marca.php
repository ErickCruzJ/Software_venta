<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat_marca extends Model
{
    protected $primaryKey ='id_cat_marca';

    protected $fillable = [
        'nombre', 
        'descripcion',
        'estado',
    ];

    protected function casts():array
    {
        return[
            'estado' => 'boolean',
        ];
    }
    public function producto()
    {
        return $this->hasMany(Producto::class, 'id_producto');
    }
}
