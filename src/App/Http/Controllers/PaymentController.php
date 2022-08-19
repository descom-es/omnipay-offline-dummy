<?php

namespace Omnipay\OfflineDummy\App\Http\Controllers;

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
        ]);

        return view('omonipay-offline-dummy::payment', [
            'transactionId' => $request->input('transaction_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'label_success' => App::STATUS_SUCCESS,
            'label_denied' => App::STATUS_DENIED,
        ]);
    }
}
