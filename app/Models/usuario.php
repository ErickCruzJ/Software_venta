<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $primaryKey = 'id_usuario';

    protected $fillable =[
        'id_empleado',
        'id_rol',
        'nombre_usuario',
        'password',
        'ultima_conexion',
        'estado',
    ];

    protected function casts(): array
    {
        return[
            'password' => 'hashed',
            'ultima_conexion' => 'datetime',
        ];
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class,'id_rol');
    }
    public function empleado():BelongsTo
    {
        return $this->belomgsTo(Empleado::class,'id_empleado');
    }
    public function inventarios(): HasMany
    {
        return $this->hasMany(Inventario::class, 'id_usuario');
    }
}
