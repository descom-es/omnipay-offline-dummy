<?php

namespace Omnipay\BankTransfer\Tests;

use Illuminate\Support\Facades\Http;
use Omnipay\BankTransfer\App\App;
use Omnipay\BankTransfer\Gateway;
use Omnipay\Omnipay;

class AppTest extends TestCase
{
    private Gateway $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create('BankTransfer');
    }

    public function testPurchase()
    {
        $response = $this->gateway
            ->purchase(
                [
                    'amount' => '12.00',
                    'description' => 'Test purchase',
                    'transactionId' => 1,
                    'notify_url' => 'http://localhost:8080/gateway/notify',
                    'url_return' => 'http://localhost:8080/gateway/return',
                ]
            )->send();

        $responseHttp = $this->postJson($response->getRedirectUrl(), [
            'transaction_id' => $response->getData()['transaction_id'],
            'amount' => $response->getData()['amount'],
            'description' => $response->getData()['description'],
        ])->assertStatus(200)
            ->assertSee('<form method="POST" action="/payment/process">', false);
    }

    public function testCompletePurchase()
    {
        Http::fake();

        $responseHttp = $this->postJson('/payment/process', [
            'transaction_id' => 1,
            'amount' => 12.00,
            'description' => 'Test purchase',
            'url_notify' => 'http://localhost:8080/gateway/notify',
            'url_return' => 'http://localhost:8080/gateway/return',
            'status' => App::STATUS_SUCCESS,
        ])->assertStatus(302)
            ->assertRedirect('http://localhost:8080/gateway/return?status=ACEPTAR PAGO');

        Http::assertSent(function ($request) {
            return $request->url() === 'http://localhost:8080/gateway/notify';
        });
    }
}
