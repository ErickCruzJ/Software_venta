<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquest\Relations\BelongsToMany;

class Permiso extends Model
{
    protected $table = 'permisos';

    protected $primaryKey = 'id_permiso';

    protected $fillable = [
        'nombre',
        'codigo',
        'modulo',
        'accion',
        'descripcion',
        'estado',
    ];

    protected function casts(): array
    {
        return[
            'estado'=> 'boolean',
        ];
    }

    public function roles(): BelongToMany
    {
        return $this->belongsToMany(
            Rol::class,
            'rol_permiso',
            'id_permiso',
            'id_rol'
        )->withPivot('created_at');
    }
}
