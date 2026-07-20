<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illiminate\Database\Eloquent\Relations\HasMany;

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
    public function producto():HasMany
    {
        return $this->hasMany(Producto::class, 'id_cat_marca');
    }
}
