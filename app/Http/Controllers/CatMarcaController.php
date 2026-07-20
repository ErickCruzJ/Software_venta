<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreCatMarcaRequest;
use App\Http\Request\UpdateCatMarcaRequest;
use App\Models\CatMarca;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CatMarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $marcas = CatMarca::orderBy('nombre')->get();

        return Inertia::render('CatMarcas/Index',[
            'marcas' => $marcas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('CatMarca/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatMarcaRequest $request):RedirectResponse
    {
        CatMarca::create($request->validated());
        return redirect()
            ->route('cat-marca.index')
            ->with('success', 'Marca creadad con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CatMarca $catMarca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatMarca $catMarca): Response
    {
        return Inertia::render('CatMarca/Edit',[
            'catMarca' => $catMarca,
        ])
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatMarcaRequest $request, CatMarca $catMarca):RedirectResponse
    {
        CatMarca::update($request->validated());

        return redirect()
            ->route('cat-marca.index')
            ->with('success', 'Marca actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatMarca $catMarca): RediorectResponse
    {
        $catMarca ->delete();

        return redirect()
            ->route('cat-marca.index')
            ->with('success','Marca eliminada correctamente.');
    }
}
