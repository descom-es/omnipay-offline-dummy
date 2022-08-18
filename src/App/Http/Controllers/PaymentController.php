<?php

namespace Omnipay\RedirectDummy\App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Routing\Controller;
use Omnipay\RedirectDummy\App\App;

class PaymentController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'transactionId' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'notifyUrl' => 'required|url',
        ]);

        return view('redirectdummy::payment', [
            'transactionId' => $request->input('transitionId'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'notifyUrl' => $request->input('notifyUrl'),
            'label_success' => App::STATUS_SUCCESS,
            'label_denied' => App::STATUS_DENIED,
        ]);
    }
}