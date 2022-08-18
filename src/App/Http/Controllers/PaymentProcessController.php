<?php

namespace Omnipay\RedirectDummy\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Omnipay\Omnipay;

class PaymentProcessController extends Controller
{
    public function __invoke(Request $request)
    {
        $gateway = Omnipay::create('RedirectDummy');

        $response = $gateway->completePurchase($request->all())->send();

        return response()->json(['message' => $response->getMessage()]);
    }
}