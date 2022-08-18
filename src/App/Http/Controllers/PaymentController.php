<?php

namespace Omnipay\OfflineDummy\App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Omnipay\OfflineDummy\App\App;

class PaymentController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'notify_url' => 'required|url',
        ]);

        return view('omonipay-offline-dummy::payment', [
            'transactionId' => $request->input('transaction_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'notifyUrl' => $request->input('notify_url'),
            'label_success' => App::STATUS_SUCCESS,
            'label_denied' => App::STATUS_DENIED,
        ]);
    }
}