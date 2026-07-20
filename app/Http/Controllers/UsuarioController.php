<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $usuario = Usuario::orderBy('nombre_usuario')->get();
        return Inertia::render('Usuarios/Index',[
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        return Inertia::render('Usuarios/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request):RedirectResponse
    {
        Usuario::create($request->validated());

        return redirect()
            ->route('usuarios.index')
            ->with('success','Usuario creado correctmente');
    }

    /**
     * Display the specified resource.
     */
    public function show(usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(usuario $usuario):Response
    {
        return Inertia::render('Usuarios/Edit',[
            'usuario' => $usuario
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, usuario $usuario):RedirectResponse
    {
        $usuario ->update($request->validated());
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(usuario $usuario):RedirectResponse
    {
        $usuario->delete();
        return redirect()
            ->route('usuario.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
