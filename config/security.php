<?php
return[
    /*Tiempo máximo de inactividad (minutos) */
    'session_timeout' => env('SECURITY_SESSION_TIMEOUT',30),
    /*Tiempo maximode vida del token (minutos) */
    'token_expiration' =>env('SECURITY_TOKEN_EXPIRATION', 120),
    /*Algoritmo de firma*/
    'algorithm' => 'sha256',
    /*Versión de protocolo SST*/
    'version' => 1.0
];