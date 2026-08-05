<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifySessionToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()){
            $usuario = Auth::user();

            $tokenSesion = $request->session()->get('usuario_token_sesion');

            if(
                $usuario->token_sesion !== null &&
                $usuario->token_sesion !== $tokenSesion
            ){
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()
                    ->toute('login')
                    ->with(
                        'error',
                        'Tu sesion fue cerrada porque se inicio desde otro dispositivo.'
                    );
            }
        }
        return $next($request);
    }
}
