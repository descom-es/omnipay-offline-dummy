<?php

namespace Omnipay\OfflineDummy\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Omnipay\Omnipay;

class PaymentProcessController extends Controller
{
    public function __invoke(Request $request)
    {
        $gateway = Omnipay::create('OfflineDummy');

        $response = $gateway->completePurchase($request->all())->send();

        Http::acceptJson()->post(
            $gateway->getUrlNotify(),
            $response->getData()
        );

        return response()->redirectTo($gateway->getUrlReturn());
    }
}