<?php

namespace App\Http\Middleware;

use App\Services\Security\TokenValidator;
use App\Services\Security\TokenStorage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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

            return $this->rejectSession($request);
        }
        
        $expired = $this->validator->expired($token);

        if($expired){

            return $this->rejectSession($request);
        }

        $usuario = $request->user();

        if(!$usuario){

            return $this->rejectSession($request);
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

            return $this->rejectSession($request);
        }
        return $next($request);
   }
    private function rejectSession(Request $request)
        {
            Auth::logout();

            $request->session()->forget('sst_token');

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');
        }
}
