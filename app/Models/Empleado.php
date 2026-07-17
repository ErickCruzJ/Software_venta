<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $primaryKey = 'id_empleado';
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'calle',
        'numero',
        'codigo_postal',
        'colonia',
        'alcaldia',
        'ciudad',
        'telefono',
        'correo',
        'fecha_contratacion',
        'foto',
        'estado',
    ];
    protected function casts():array
    {
        return[
            'fecha_contratacion' => 'date',
        ];
    }
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id_usuario');
    }
}
