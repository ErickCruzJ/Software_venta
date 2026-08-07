<?php
return[
    /*Tiempo máximo de inactividad (minutos) */
    'session_timeoutt' => env('SECURITY_SESSION_TIMEOUT',30),
    /*Tiempo maximode vida del token (minutos) */
    'token_expiration' =>env('SECURITY_TOKEN_EXPIRATION', 120),
    /*Algoritmo de firma*/
    'algoirthm' => 'sha256',
    /*Versión de protocolo SST*/
    'version' => 1.0
];