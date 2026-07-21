<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});
    Route::get('/categorias',[CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias',[CategoriaController::class,'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit',[CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}',[CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria:id_categoria}', [CategoriaController::class, 'destroy'])-> name('categorias.destroy');

Route::get('/empleados',[EmpleadoController::class, 'index'])->name('empleados.index');
Route::get('/empleados/create',[EmpleadoController::class, 'create'])->name('empleados.create');
Route::post('/empleados',[EmpleadoController::class, 'store'])->name('categoria.store');
Route::get('/empleados/{empleado}/edit',[EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::put('/empleados/{empleado}/',[EmpleadoController::class, 'update'])->name('empleados.update');
Route::delete('/empleados/{empleado:id_empleado}',[EmpleadoController::class, 'destroy'])->name('empleados.destroy');
Route::middleware(['auth'])->group(function(){
   
});
require __DIR__.'/settings.php';
