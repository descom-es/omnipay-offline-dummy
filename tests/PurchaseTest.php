<?php

namespace Omnipay\RedirectDummy\Tests;

use Omnipay\Omnipay;
use Omnipay\RedirectDummy\Gateway;
use Omnipay\RedirectDummy\Message\PurchaseRequest;
use Omnipay\RedirectDummy\Message\PurchaseResponse;
use Omnipay\RedirectDummy\Tests\TestCase;
use Omnipay\Tests\GatewayTestCase;

class PurchaseTest extends TestCase
{
    private Gateway $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create('RedirectDummy');
    }

    public function testPurchaseRequest()
    {
        $request = $this->gateway->purchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'notifyUrl' => 'http://localhost:8080/gateway/notify',
        ]);

        $this->assertInstanceOf(PurchaseRequest::class, $request);
        $this->assertSame('12.00', $request->getAmount());
    }

    public function testPurchaseSend()
    {
        $response = $this->gateway->purchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'notifyUrl' => 'http://localhost:8080/gateway/notify',
        ])->send();

        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('http://localhost/payment', $response->getRedirectUrl());
        $this->assertEquals('http://localhost:8080/gateway/notify', $response->getData()['notify_url']);
    }

    public function testPurchaseRedirect()
    {
        $responseHtml = $this->gateway
            ->purchase([
                'amount' => '12.00',
                'description' => 'Test purchase',
                'transactionId' => 1,
                'notifyUrl' => 'http://localhost:8080/gateway/notify',
            ]
            )->send()
            ->getRedirectResponse()
            ->getContent();

        $this->assertStringContainsString(
            '<input type="hidden" name="notify_url" value="http://localhost:8080/gateway/notify" />',
            $responseHtml
        );

        $this->assertStringContainsString(
            '<input type="hidden" name="transaction_id" value="1" />',
            $responseHtml
        );

        $this->assertStringContainsString(
            '<input type="hidden" name="amount" value="12.00" />',
            $responseHtml
        );
    }
}