<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetupAdminRequest;
use App\Models\Rol;
use App\Models\Usuario;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

use Inertia\Inertia;
use Inertia\Response;



class SetupController extends Controller
{
    /**
     * Mustra la configuracion inicial del sistema.
     */
    public  function index(): Response|RedirectResponse
    {
        if(Usuario::exists()){
            return redirect()
                ->route('login')
                ->with(
                    'info',
                    'El sistema ya fue configurado. Inicia sesión para continuar.'
                );
        }
        return Inertia::render('Setup/Index');
    }
    public function store(SetupAdminRequest $request): RedirectResponse
    {
        //Evita que el proceso pueda ejecutarse
        //despúes de que ya existe uin usuario
        if(Usuario::exists()){
            return redirect()
                ->route('login')
                ->withe(
                    'info',
                    'El sistema ya fue configurado. Inicia sesión para continuar.'
                );
        }

        DB::transaction(function () use ($request){

            $rol = Rol::firstOrCreate(
                [
                    'nombre' => 'Administrador',
                ],
                [
                    'descripcion' => 'Tiene acceso completo al sistema.',
                    'estado' => true,
                ]
            );
            Usuario::create([
                'id_empleado' => null,
                'id_rol' => $rol->id_rol,
                'nombre_usuario' => $request->nombre_usuario,
                'password' => $request->password,
                'estado' => 'Desconectado',
                'intentos_fallidos' => 0,
                'bloqueado_hasta' => null,
                'token_sesion' => null,
            ]);
        });

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Administrador creado correctamente. Ahora puedes iniciar sesión,'
            );
    }
}
