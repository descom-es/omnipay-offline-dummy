<?php

namespace Omnipay\OfflineDummy\App;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Omnipay\OfflineDummy\App\Http\Controllers\PaymentController;
use Omnipay\OfflineDummy\App\Http\Controllers\PaymentProcessController;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->registerRouters();

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'omonipay-offline-dummy');
    }

    private function registerRouters(): void
    {
        Route::middleware('web')->group(function () {
            Route::post('/payment', PaymentController::class);
            Route::post('/payment/process', PaymentProcessController::class);
        });
    }
}
