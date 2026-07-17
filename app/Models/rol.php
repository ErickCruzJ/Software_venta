<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ] ;
    protected function casts():array
    {
        return[
            'estado' => 'boolean',
        ];
    }
    public function productos()
    {
        return $this->hasMany(Usuario::class, 'id_rol');
    }
}
