<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use App\Services\CategoriaService;
use Inertia\Inertia;

class CategoriaController extends Controller
{
    protected CategoriaService $categoriaService;
    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = $this->categoriaService->obteneterCategorias();
        return Inertia::render('Categorias/Index',['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Categorias/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        $this->categoriaService->crear($request->validated());
        return redirect()->route('categorias.index')->with('success','Categoria registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return Inertia::render('Categorias/Edit',[
            'categoria' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $this->categoriaService->actualizar($categoria, $request->validated());
        return redirect()->route('categorias.index')->with('success','Categoria actualizada correctamente.');     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $this->categoriaService->eliminar($categoria);
        return redirect()->route('categorias.index')->with('success','Categoria eliminada correctamente.');
    }
}
