<?php

namespace App\Observers;

use App\Models\Categoria;
use Illuminate\Support\Facades\Log;

class CategoriaObserver
{
    /**
     * Handle the Categoria "created" event.
     */
    public function created(Categoria $categoria): void
    {
        Log::info('Categoria creada',[
            'id_categoria' => $categoria->id_categoria,
            'datos' => $categoria->toArray(),
            'usuario_id' => auth()->id(),
            'fecha' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Handle the Categoria "updated" event.
     */
    public function updated(Categoria $categoria): void
    {
        Log::info('Categoria actualizada',[
            'id_categoria' => $categoria->id_categoria,
            'cambios' => $categoria->getChanges(),
            'usuario_id' => auth()->id(),
            'fecha' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Handle the Categoria "deleted" event.
     */
    public function deleted(Categoria $categoria): void
    {
        Log::warning('Categoria eliminada', [
            'id_categoria' => $categoria->id_categoria,
            'datos'=>$categoria->toArray(),
            'usuario_id' => auth()->id(),
            'fecha' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Handle the Categoria "restored" event.
     */
    public function restored(Categoria $categoria): void
    {
        //
    }

    /**
     * Handle the Categoria "force deleted" event.
     */
    public function forceDeleted(Categoria $categoria): void
    {
        //
    }
}
