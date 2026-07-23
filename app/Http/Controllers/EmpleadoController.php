<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empleado;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia; 
use Inertia\Response;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :Response
    {
        $empleados = Empleado::orderBy('nombre')->get();

        return Inertia::render('Empleados/Index',[
            'empleados' => $empleados,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :Response
    {
        return Inertia::render('Empleados/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpleadoRequest $request): RedirectResponse
    {
        Empleado::create ($request->validated());

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleados registrada correctamente. ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado): Response
    {
        return Inertia::render('Empleados/Edit',[
            'empleado' => $empleado
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadoRequest $request, Empleado $empleado): RedirectResponse
    {
        $empleado -> update($request -> validated());
        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente. ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado): RedirectResponse
    {
        $empleado->delete();

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empledo eliminado corrcetamentre');
    }
}