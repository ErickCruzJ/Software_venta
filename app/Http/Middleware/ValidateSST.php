<?php

namespace App\Http\Middleware;

use App\Services\Security\TokenValidator;
use App\Services\Security\TokenStorage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateSST
{
   public function __construct(
        private TokenValidator $validator,
        private TokenStorage $storage
   ){}

   public function handle(
        Request $request,
        Closure $next
   ):Response{

        $token = $request->session()->get('sst_token');

        if(!$token){
            return redirect('/login');
        }

        $validSignature = $this->validator->validate($token);

        if(!$validSignature){
            $request->session()->forget('sst_token');

            return redirect('/login');
        }

        $expired = $this->validator->expired($token);

        if($expired){
            $request->session()->forget('sst_token');

            return redirect('/login');
        }

        $usuario = $request->user();

        if(!$usuario){
            $request->session()->forget('sst_token');

            return redirect('/login');
        }
        $tokenValido = $this->storage->verify(
            $usuario,
            $token
        );
        
        logger()->info('====SST BD======',[
            'usuario_id' => $usuario->id_usuario,
            'valid' => $tokenValido,
        ]);
        if(!$tokenValido){
            $request->session()->forget('sst_token');

            return redirect('/login');
        }
        return $next($request);
   }
}
