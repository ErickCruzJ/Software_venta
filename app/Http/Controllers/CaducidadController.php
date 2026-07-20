<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaducidadRequest;
use App\Http\Requests\UpdateCaducidad\Request;
use App\Models\caducidad;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CaducidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $caducidad = Caducidad::orderBy('nombre')->ge();

        return Inertia::render('Caducidades/Index',[
            'caducidad' => $caducidad,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        return Inertia::render('Caducidades/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaducidadRequest $request):RedirectResponse
    {
        Caducidad::create($request->validated());
        return redirect()
            ->route('caducidades.index')
            ->with('success', 'Caducidad registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(caducidad $caducidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(caducidad $caducidad):Response
    {
        return Inertia::render('Caduciudades/Edit',[
            'caducidad' => $caducidad
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaducidadRequest $request, caducidad $caducidad): RedirectResponse
    {
        $caducidad ->update($request->validated());
        return redirect()
            ->route('caducidades.index')
            ->white('success', 'Caducidad actualizada correctamente. ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(caducidad $caducidad):RedirectResponse
    {
        $caducidad->delete();
        return redirect()
            ->route('caducidades.index')
            ->with('success', 'Caducidad eliminada correctamente');
    }
}
