<?php
namespace App\Services\Security;

class TokenValidator
{
    /*Valida la firma del SST */

   public function validate(string $token): bool
   {
        $parts = explode ('.', $token);

        if (count($parts) !== 3 ){
            return false;
        }
        [$header, $payload, $signature] = $parts;

        $expectedSignature = hash_hmac(
            'sha256',
            "{$header}.{$payload}",
            config('app.key')
        );

        return hash_equals(
            $expectedSignature,
            $signature
        );
   }
    /*Obtiene el payload */
    public function payload(string $token): ?array
    {
        $parts = explode('.', $token);

        if (count($parts) !==3){
            return null;
        }
        $payload = json_decode(
            base64_decode(
                strtr($parts[1],'-_','+/')
            ),
            true
        );
        return is_array($payload)
            ?$payload
            :null;
    }
    /*Verificacion */
    public function expired(string $token): bool
    {
        $payload = $this->payload($token);

        if(!$payload){
            return true;
        }

        if(!isset($payload['exp'])){
            return true;
        }

        return now()->timestamp > $payload['exp'];
    }
}