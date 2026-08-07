<?php

namespace App\Services\Security;

use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SecuritySessionService
{
    public function __construct(
        private TokenGenerator $generator,
        private TokenStorage $storage,
    ){}

    public function registrarLogin(
        Usuario $usuario,
        Request $request
    ):string 
    {
        $token = $this->generator->generate(
            $usuario, 
            $request
        );
        $this->storage->store(
            $usuario,
            $token
        );
        $request->session()->put(
            'sst_token',
            $token
        );
        $usuario->update([
            'ultima_conexion' => now(),
            'estado' => 'Conectado',
            'intentos_fallidos' => 0,
            'bloqueado_hasta' => null,
        ]);
        return $token;
    }
}
