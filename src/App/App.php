<?php

namespace Omnipay\OfflineDummy\App;

class App
{
    const STATUS_SUCCESS = 'ACEPTAR PAGO';
    const STATUS_DENIED = 'RECHAZAR PAGO';

    public static function url(string $path): string
    {
        return url($path);
    }
}