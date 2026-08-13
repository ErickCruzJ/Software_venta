<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Models\Usuario;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
        Fortify::authenticateUsing(function (Request $request) {

            $usuario = Usuario::whereRaw(
                'LOWER(nombre_usuario) = ?',
                [strtolower($request->nombre_usuario)]
            )->first();

            logger()->info('Usuario encontrado',[
                'usuario' => $usuario,
            ]);

            if(!$usuario){
                logger()->warning('Usuario no encontrado.');

                return null;
            }

            /*Veriuficar bloqueo */
            
            if($usuario->bloqueado_hasta !== null&&
                now()->lessThan($usuario->bloqueado_hasta)
            ){
                logger()->warning('Usuario bloqueado',[
                    'usuario_id' => $usuario->id_usuario,
                    'bloqueado_hasta' => $usuario->bloqueado_hasta,
                ]);
                return null;
                
            }

            /*Si el bloqueo ya termino */

            if(
                $usuario->bloqueado_hasta !== null &&
                now()->greaterThanOrEqualTo($usuario->bloqueado_hasta)
            ){
                $usuario->update([
                    'intentos_fallidos' => 0,
                    'bloqueado_hasta' => null,
                ]);

                logger()->info('Bloqueo terminado', [
                    'usuario_id' => $usuario->id_usuario,
                ]);
            }

            /*Verificar contraseña */

            $passwordCorrecta  = Hash::check(
                $request->password,
                $usuario->password
            );

            logger()->info('Contraseña correcta',[
                'resultado' => $passwordCorrecta,
            ]);

            if(! $passwordCorrecta){

                $usuario->increment('intentos_fallidos');

                logger()->warning('Intentos de contraseña incorrecta',[
                    'usuario_id' => $usuario->id_usuario,
                    'intentos_fallidos' => $usuario->fresh()->intentos_fallidos,
                ]);

                $usuario->refresh();

                if($usuario->intentos_fallidos >= 5){

                    $usuario->update([
                        'bloqueado_hasta' => now()->addMinutes(10),
                    ]);

                    logger()->warning('USUARIO BLOQUEADO',[
                        'usuario_id' => $usuario->id_usuario,
                        'bloqueado_hasta' => $usuario->bloqueado_hasta,
                    ]);
                }

                return null;
            }

            /*Login correcto */

            $usuario->update([
                'intentos_fallidos' => 0,
                'bloqueado_hasta' => null,
            ]);

            logger()->info('Login correcto');

            return $usuario;
        });
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn (Request $request) => Inertia::render('auth/login', [
            'canResetPassword' => Features::enabled(Features::resetPasswords()),
            'status' => $request->session()->get('status'),
        ]));

        Fortify::resetPasswordView(fn (Request $request) => Inertia::render('auth/reset-password', [
            'email' => $request->email,
            'token' => $request->route('token'),
            'passwordRules' => Password::defaults()->toPasswordRulesString(),
        ]));

        Fortify::requestPasswordResetLinkView(fn (Request $request) => Inertia::render('auth/forgot-password', [
            'status' => $request->session()->get('status'),
        ]));

        Fortify::verifyEmailView(fn (Request $request) => Inertia::render('auth/verify-email', [
            'status' => $request->session()->get('status'),
        ]));

        Fortify::registerView(fn () => Inertia::render('auth/register', [
            'passwordRules' => Password::defaults()->toPasswordRulesString(),
        ]));

        Fortify::twoFactorChallengeView(fn () => Inertia::render('auth/two-factor-challenge'));

        Fortify::confirmPasswordView(fn () => Inertia::render('auth/confirm-password'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('passkeys', function (Request $request) {
            return Limit::perMinute(10)->by(
                ($request->input('credential.id') ?: $request->session()->getId()).'|'.$request->ip(),
            );
        });
    }
}
