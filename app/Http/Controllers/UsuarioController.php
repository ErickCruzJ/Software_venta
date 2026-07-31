<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Empleado;
use App\Models\Rol;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $usuarios = Usuario::orderBy('nombre_usuario')->get();
        return Inertia::render('Usuarios/Index',[
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Empleado $empleado):Response
    {
        
        if($empleado->usuario) {
            return redirect()
                ->route('empleados.index')
                ->with('error', 'Esate empleado ya tiene una cuenta de usuario.');
        }

        $roles = Rol::where('estado',true)
            ->orderBy('nombre')
            ->get(['id_rol', 'nombre', 'descripcion',]);
        
        return Inertia::render('Usuarios/Create',[
            'empleado' => $empleado,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request):RedirectResponse
    {
        try{
            $datos = $request->validated();

            $datos['estado'] = 'Desconectado';

            Usuario::create($datos);

            return redirect()
                ->route('usuarios.index')
                ->with('success','Usuario creado correctmente');
        }catch (\Throwable $e){
            dd(
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }

        
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
    public function edit(Usuario $usuario):Response
    {
        return Inertia::render('Usuarios/Edit',[
            'usuario' => $usuario
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario):RedirectResponse
    {
        $usuario ->update($request->validated());
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario):RedirectResponse
    {
        $usuario->delete();
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
