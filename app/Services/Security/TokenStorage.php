<?php

namespace App\Services\Security;

use App\Models\Usuario;

class TokenStorage
{
   /*Guardar el hash del token */

   public function store(
        Usuario $usuario,
        string $token
   ): void{
        $usuario->update([
            'token_sesion' => hash(
                'sha256',
                $token
            ),
        ]);
   }
   /*Obtinene el hash almacenado */
   public function getHash(
    Usuario $usuario
   ): ?string{
        return $usuario->token_sesion;
   }
   /*Elimina el token */
   public function destroy(
        Usuario $usuario
   ): void{
    $usuario->update([
        'token_sesion' => null,
    ]);
   }
   /*Verifica si coincide */
   public function verify (
        Usuario $usuario,
        string $token
   ): bool{
        return hash_equals(
            $usuario->token_sesion ?? '',
            hash(
                'sha256',
                $token
            )
        );
   }
}
