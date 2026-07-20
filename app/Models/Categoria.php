<?php

namespace App\Models;

use App\Observers\CategoriaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([CategoriaObserver::class])]
class Categoria extends Model
{

    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];
    protected function casts():array
    {
        return [
            'estado' => 'boolean',
        ];
    }

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }

}
