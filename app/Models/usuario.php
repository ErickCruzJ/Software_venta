<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de Autentificación de Usuarios.
 * 
 * Representa la entidad de usuario en la base de datos para la autenticación en la plataforma.
 * Mantiene el estado de acceso, credenciales, control de bloqueo por seguridad
 * y la vinculación con la información del empleado y sus permiso (rol).
 * 
 * @property int $id_e
 */

class Usuario extends Authenticatable
{
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_empleado',
        'id_rol',
        'nombre_usuario',
        'password',
        'ultima_conexion',
        'estado',

        'intentos_fallidos',
        'bloqueado_hasta',
        'token_sesion',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'ultima_conexion' => 'datetime',
            'bloqueado_hasta' => 'datetime',
        ];
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function tienePermiso(string $codigo): bool 
    {
        if(!$this->rol){
            return flase;
        }
        return $this->rol
            ->permisos()
            ->where('codigo', $codigo)
            ->where('estado', true)
            ->exists();
    }

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function inventarios(): HasMany
    {
        return $this->hasMany(Inventario::class, 'id_usuario');
    }
}
