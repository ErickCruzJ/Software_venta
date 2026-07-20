<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use App\Models\Inventario;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $inventarios = Inventario::orderBy('nombre')->get();
        return Inertia::render('Inventarios/Index',[
            'inventarios' => $inventarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response 
    {
        return Inertia::render('Inventarios/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventarioRequest $request):RedirectResponse
    {
        Inventario::create($request->validated());
        return redirect()
            ->route('inventarios.index')
            ->with('success', 'Inventario registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventario $inventario):Response
    {
        return Inertia::render('Inventarios/Edit',[
            'inventario' => $inventario
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventarioRequest $request, inventario $inventario):RedirectResponse
    {
        $inventario->update($request->validated());
        return redirect()
            ->route('inventarios.index')
            ->with('success','Inventario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventario $inventario):RedirectResponse
    {
        $inventario->delete();
        return redirect()
            ->route('inventarios.index')
            ->with('success', 'Inventario actualizado correctamente');
    }
}
