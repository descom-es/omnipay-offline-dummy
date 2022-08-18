<?php

namespace Omnipay\OfflineDummy\Tests;

use Omnipay\OfflineDummy\App\App;
use Omnipay\OfflineDummy\Gateway;
use Omnipay\OfflineDummy\Message\CompletedPurchaseRequest;
use Omnipay\OfflineDummy\Message\CompletedPurchaseResponse;
use Omnipay\Omnipay;

class CompletedPurchaseTest extends TestCase
{
    private Gateway $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create('OfflineDummy');
    }

    public function testCompletedPurchaseRequest()
    {
        $request = $this->gateway->completePurchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
        ]);

        $this->assertInstanceOf(CompletedPurchaseRequest::class, $request);
        $this->assertSame('12.00', $request->getAmount());
    }

    public function testCompletedPurchaseResponseSuccess()
    {
        $response = $this->gateway->completePurchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'status' => App::STATUS_SUCCESS,
        ])->send();

        $this->assertInstanceOf(CompletedPurchaseResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
    }

    public function testCompletedPurchaseResponseDenied()
    {
        $response = $this->gateway->completePurchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'status' => App::STATUS_DENIED,
        ])->send();

        $this->assertInstanceOf(CompletedPurchaseResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
    }
}
