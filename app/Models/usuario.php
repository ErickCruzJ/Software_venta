<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $primaryKey = 'id_usuario';

    protected $fillabel =[
        'id_empleado',
        'id_rol',
        'nombre_usuario',
        'password',
        'ultma_conexion',
        'estado',
    ];

    protected function casts(): aray
    {
        return[
            'password' => 'hashed',
            'ultima_conexion' => 'date',
        ];
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class,'id_rol');
    }
    public function empleado()
    {
        return $this->belongTo(Empleado::class,'id_empleado');
    }
    public function inventario()
    {
        return $this->belongsRTo(Inventario::class,'id_inventario')
    }
}
