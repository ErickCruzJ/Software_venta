<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;
use App\Models\Rol;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $roles = Rol::orderBy('nombre')->get();
        return Inertia::render('Roles/Index',[
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        return Inertia::render('Roles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolRequest $request):RedirectResponse
    {
        Rol::create($request->validated());

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rol $rol):Response
    {
        return Inertia::render('Roles/Edit',[
            'rol'=> $rol
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolRequest $request, rol $rol):RedirectResponse
    {
        $rol->update($request->validated());
        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rol $rol):RedirectResponse
    {
        $rol->delete();
        return redirect()
            ->route('roles.index')
            ->with('success','Rol eliminado correctamente.');
    }
}
