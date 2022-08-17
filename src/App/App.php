<?php

namespace Omnipay\RedirectDummy\App;

class App
{
    public static function url(string $path): string
    {
        return url($path);
    }
}