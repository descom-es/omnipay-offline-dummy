<?php

namespace Omnipay\OfflineDummy\App;

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'omnipay-offline-dummy');
    }

    private function registerRouters(): void
    {
        $csrfMiddleware = [
            PreventRequestForgery::class, // Laravel 13
            ValidateCsrfToken::class, // Laravel 12
            VerifyCsrfToken::class, // Laravel 11
        ];

        Route::middleware('web')
            ->group(function () use ($csrfMiddleware) {
                Route::post('/payment', PaymentController::class)->withoutMiddleware($csrfMiddleware);
                Route::post('/payment/process', PaymentProcessController::class)->withoutMiddleware($csrfMiddleware);
            });
    }
}
