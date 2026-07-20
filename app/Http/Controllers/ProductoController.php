<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $productos = Producto::orderBy('nombre')->get();
        return Inertia::render('Productos/Index',[
            'productos' => $productos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        return Inertia::render('Productos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request):RedirectResponse
    {
        Producto::create($request->validated());

        return redirect()
        ->route('productos.index')
        ->with('success', 'Producto ingresado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(producto $producto):Response
    {
        return Inertia::render('Productos/Edit',[
            'producto' => $producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, producto $producto):RedirectResponse
    {
       $producto->update($request->validated());
       return redirect()
        ->route('productos.index')
        ->with('success', 'Producto actualizado correctamente'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(producto $producto):RedirectResponse
    {
        $producto->delete();
        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
