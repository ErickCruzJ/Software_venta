<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/categorias',[CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias',[CategoriaController::class,'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit',[CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}',[CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categorias}', [CategoraController::class, 'destroy'])->name('categorias.destroy');    
});
require __DIR__.'/settings.php';
