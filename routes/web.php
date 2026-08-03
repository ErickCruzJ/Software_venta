<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;

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
Route::post('/empleados',[EmpleadoController::class, 'store'])->name('empleados.store');
Route::get('/empleados/{empleado}/edit',[EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::put('/empleados/{empleado}',[EmpleadoController::class, 'update'])->name('empleados.update');
Route::delete('/empleados/{empleado:id_empleado}',[EmpleadoController::class, 'destroy'])->name('empleados.destroy');

Route::get('/roles',[RolController::class, 'index'])->name('roles.index');
Route::get('/roles/create',[RolController::class, 'create'])->name('roles.create');
Route::post('/roles',[RolController::class, 'store'])->name('roles.store');
Route::get('/roles/{rol}/edit',[RolController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{rol}',[RolController::class, 'update'])->name('roles.update');
Route::delete('/roles/{rol:id_rol}',[RolController::class, 'destroy'])->name('roles.destroy');

Route::get('/usuarios',[UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('empleados/{empleado}/usuario',[UsuarioController::class, 'createDesdeEmpleado'])->name('usuarios.create.empleado');
Route::get('usuarios/sinempleado/create',[UsuarioController::class, 'createSinEmpleado'])->name('usuarios.create.sinempleado');
Route::post('/usuarios',[UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{usuario}/edit',[UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{usuario}',[UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuario/{usuario}',[UsuarioController::class, 'destroy'])->name('usuarios.destroy');

Route::middleware(['auth'])->group(function(){
   
});
require __DIR__.'/settings.php';
