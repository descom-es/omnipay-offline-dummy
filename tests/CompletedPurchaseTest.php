<?php

namespace Omnipay\BankTransfer\Tests;

use Omnipay\BankTransfer\App\App;
use Omnipay\BankTransfer\Gateway;
use Omnipay\BankTransfer\Message\CompletedPurchaseRequest;
use Omnipay\BankTransfer\Message\CompletedPurchaseResponse;
use Omnipay\Omnipay;

class CompletedPurchaseTest extends TestCase
{
    private Gateway $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create('BankTransfer');
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

    public function testCompletedPurchaseResponseGetReference()
    {
        $response = $this->gateway->completePurchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'status' => App::STATUS_SUCCESS,
        ])->send();

        $this->assertInstanceOf(CompletedPurchaseResponse::class, $response);
        $this->assertNotEmpty($response->getTransactionReference());
    }

    public function testCompletedPurchaseResponseSuccess()
    {
        $response = $this->gateway->completePurchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'status' => App::STATUS_SUCCESS,
        ])->send();

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

        $this->assertFalse($response->isSuccessful());
    }
}
