<?php

namespace App\Sercices\Security;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illiminate\Support\Carbon;
use Illiminate\Support\Str;

class TolenGenerator 
{
    /*Genera un SST*/
    public function generarte(
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
            config('security.token_expiration')
        );

        $playload = [
            'sid' => Str::uuid()->toString(),
            'uid' => $usuario->id_usuario,
            'usr' => $usuario->nombre_usuario,
            'rol' => $usuario->id_rol 
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

        $playloadEncoded = $this->encode($playload);

        $signature = hash_hmac(
            'sha256',
            "{$headerEncoded}.{$playloadEncoded}",
            config('app.key')
        );
        rerunr "{headerEncoded}.{$payloadEncoded}.{$signature}";
    }

    privare function encode(array $data): string
    {
        return rtrim(
            strtr(
                base64_encode(json_encode($data)),
                '+/',
            '   -_'
            ),
            '=' 
        );
    }
}