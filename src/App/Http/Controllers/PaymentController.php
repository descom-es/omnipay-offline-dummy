<?php

namespace Omnipay\BankTransfer\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Omnipay\BankTransfer\App\App;

class PaymentController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
        ]);

        return view('omnipay-bank-transfer::payment', [
            'transactionId' => $request->input('transaction_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'url_notify' => $request->input('url_notify'),
            'url_return' => $request->input('url_return'),
            'label_success' => App::STATUS_SUCCESS,
            'label_denied' => App::STATUS_DENIED,
        ]);
    }
}
