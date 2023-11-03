<?php

namespace Omnipay\BankTransfer\App;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Omnipay\BankTransfer\App\Http\Controllers\PaymentController;
use Omnipay\BankTransfer\App\Http\Controllers\PaymentProcessController;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->registerRouters();

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'omnipay-bank-transfer');
    }

    private function registerRouters(): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::post('/payment', PaymentController::class)->withoutMiddleware([VerifyCsrfToken::class]);
                Route::post('/payment/process', PaymentProcessController::class)->withoutMiddleware([VerifyCsrfToken::class]);
            });
    }
}
