<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    
    protected $table = 'categorias';

    protected $primarykey = 'id_categoria';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];
    protecred function casts():array
    {
        return [
            'estado' => 'boolean',
        ]
    }
    public function productos(): string
    {
        return 'id_categoria';
    }
}
