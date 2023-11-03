<?php

namespace Omnipay\BankTransfer\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Omnipay\Omnipay;

class PaymentProcessController extends Controller
{
    public function __invoke(Request $request)
    {
        $gateway = Omnipay::create('BankTransfer');

        $response = $gateway->completePurchase($request->all())->send();

        Http::acceptJson()->post(
            $request->input('url_notify'),
            $response->getData()
        );

        return response()->redirectTo($request->input('url_return') . '?status=' . $request->input('status'));
    }
}
