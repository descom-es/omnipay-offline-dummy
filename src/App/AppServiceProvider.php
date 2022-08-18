<?php

namespace Omnipay\RedirectDummy\App;

use Descom\Skeleton\Console\Install;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Omnipay\RedirectDummy\App\Http\Controllers\PaymentController;
use Omnipay\RedirectDummy\App\Http\Controllers\PaymentProcessController;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->registerRouters();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'redirectdummy');
    }

    private function registerRouters(): void
    {
        Route::middleware('web')->group(function () {
            Route::post('/payment', PaymentController::class);
            Route::post('/payment/process', PaymentProcessController::class);
        });
    }
}