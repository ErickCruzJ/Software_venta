<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Security\SecuritySessionService;

class GenerateSessionToken
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private SecuritySessionService $security
    ){}

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $request = request();

        logger()->info('====LOGIN EVENT =====',[
            'usuario_id' => $event->user->id_usuario,
            'session_id' => $request->session()->getId(),
        ]);
        $this->security->registrarLogin(
            $event->user,
            $request
        );
    }
}
