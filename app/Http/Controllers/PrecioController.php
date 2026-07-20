<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrecioRequest;
use App\Http\Requests\UpdatePrecioRequest;
use App\Models\Precio;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $precios = Precio::orderBy('precio_venta')->get();

        return Inertia::render('Precios/Index',[
            'precios' => $precios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        return Inertia::render('Precios/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrecioRequest $request): RedirectResponse
    {
        Precio::create($request->validated());

        return redirect()
            ->route('precios.index')
            ->with('success', 'Precio registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(precio $precio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(precio $precio): Response
    {
        return Inertia::render('Precios/Edit',[
            'precio' => $precio 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrecioRequest $request, precio $precio):RedirectResponse
    {
        $precio -> update($request->validated());
        return redirect()
            ->route('precios.index')
            ->with('success', 'Precio se actualizo con exito ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(precio $precio):RedirectResponse
    {
        $precio->delete();

        return redirect()
        ->route('precios.index')
        ->with('success', 'Precio eliminado correctamente');
    }
}
