<?php

namespace Omnipay\OfflineDummy\App;

class App
{
    public const STATUS_SUCCESS = 'ACEPTAR PAGO';
    public const STATUS_DENIED = 'RECHAZAR PAGO';

    public static function url(string $path): string
    {
        return url($path);
    }
}
