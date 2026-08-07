<?php

namespace App\Services\Security;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ToKenGenerator 
{
    /*Genera un SST*/
    public function generate(
        Usuario $usuario,
        Request $request
    ):string{
        $header =[
            'typ' => 'SST',
            'alg' => strtoupper(config('security.algorithm')),
            'ver' => config('security.version'),
        ];
        $issuedAt = now();
        $expiresAt = now()->addMinutes(
           (int) config('security.token_expiration')
        );

        $payload = [
            'sid' => Str::uuid()->toString(),
            'uid' => $usuario->id_usuario,
            'usr' => $usuario->nombre_usuario,
            'rol' => $usuario->id_rol,
            'iat' => $issuedAt->timestamp,
            'exp' => $expiresAt->timestamp,
            'ip'  => $request->ip(),
            'agent' => substr(
                $request->userAgent() ?? '',
                0,
                255
            ),
        ];

        $headerEncoded = $this->encode($header);

        $payloadEncoded = $this->encode($payload);

        $signature = hash_hmac(
            'sha256',
            "{$headerEncoded}.{$payloadEncoded}",
            config('app.key')
        );
        return "{$headerEncoded}.{$payloadEncoded}.{$signature}";
    }

    private function encode(array $data): string
    {
        return rtrim(
            strtr(
                base64_encode(json_encode($data)),
                '+/',
                '-_'
            ),
            '=' 
        );
    }
}