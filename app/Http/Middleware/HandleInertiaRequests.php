<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user()
                    ?[
                        'id_usuario' => $request->user()->id_usuario,
                        'nombre_usuario' => $request->user()->nombre_usuario,
                        'estado' => $request->user()->estado,

                        'rol' => $request->user()->rol
                            ?[
                                'id_rol' => $request->user()->rol->id_rol,
                                'nombre' => $request->user()->rol->nombre,
                            ]
                            :null,

                        'empleado'=>$request->user()->empleado
                            ?[
                                'id_empleado' => $request->user()->empleado->id_empleado,
                                'nombre' => $request->user()->empleado->nombre,
                                'apellido_paterno' => $request->user()->empleado->apellido_paterno,
                                'apellido_materno' => $request->user()->empleado->apellido_materno,
                                'foto' => $request->user()->empleado->foto,
                            ]
                            :null,
                    ]
                    :null,
            ],
        ];
    }
}
