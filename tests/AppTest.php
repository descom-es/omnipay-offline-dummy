<?php

namespace Omnipay\OfflineDummy\Tests;

use Illuminate\Support\Facades\Http;
use Omnipay\OfflineDummy\App\App;
use Omnipay\OfflineDummy\Gateway;
use Omnipay\Omnipay;

class AppTest extends TestCase
{
    private Gateway $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create('OfflineDummy');
    }

    public function testPurchase()
    {
        $response = $this->gateway
            ->purchase(
                [
                    'amount' => '12.00',
                    'description' => 'Test purchase',
                    'transactionId' => 1,
                ]
            )->send();

        $responseHttp = $this->postJson($response->getRedirectUrl(), [
            'transaction_id' => $response->getData()['transaction_id'],
            'amount' => $response->getData()['amount'],
            'description' => $response->getData()['description'],
        ])->assertStatus(200)
            ->assertSee('<form method="POST" action="/process/payment">', false);
    }

    public function testCompletePurchase()
    {
        Http::fake();

        $responseHttp = $this->postJson('/payment/process', [
            'transaction_id' => 1,
            'amount' => 12.00,
            'description' => 'Test purchase',
            'notify_url' => 'http://localhost:8080/gateway/notify',
            'status' => App::STATUS_SUCCESS,
        ])->assertStatus(302)
            ->assertRedirect($this->gateway->getUrlReturn());

        Http::assertSent(function ($request) {
            return $request->url() === $this->gateway->getUrlNotify();
        });
    }
}
