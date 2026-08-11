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

        if($request->session()->has('sst_token')){
            logger()->warning('YA EXISTE SST_TOKKEN EN ESTA SESION');
        }
          $executionId = (string) Str::uuid();

    logger()->info('===== REGISTRAR LOGIN =====', [
        'execution_id' => $executionId,
        'usuario_id' => $usuario->id_usuario,
        'session_id' => $request->session()->getId(),
    ]);
        $token = $this->generator->generate(
            $usuario, 
            $request
        );
        logger()->info('SST generador',[
            'token'=>$token,
        ]);
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
