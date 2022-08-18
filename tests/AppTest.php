<?php

namespace Omnipay\OfflineDummy\Tests;

use Illuminate\Support\Facades\Http;
use Omnipay\Omnipay;
use Omnipay\OfflineDummy\App\App;
use Omnipay\OfflineDummy\Gateway;
use Omnipay\OfflineDummy\Message\PurchaseRequest;
use Omnipay\OfflineDummy\Message\PurchaseResponse;
use Omnipay\OfflineDummy\Tests\TestCase;
use Omnipay\Tests\GatewayTestCase;

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
            ->purchase([
                'amount' => '12.00',
                'description' => 'Test purchase',
                'transactionId' => 1,
                'notifyUrl' => 'http://localhost:8080/gateway/notify',
            ]
            )->send();

        $responseHttp = $this->postJson($response->getRedirectUrl(), [
            'transaction_id' => $response->getData()['transaction_id'],
            'amount' => $response->getData()['amount'],
            'description' => $response->getData()['description'],
            'notify_url' => $response->getData()['notify_url'],
        ])->assertStatus(200)
        ->assertSee('<form action="POST" action="/process/payment">', false);
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