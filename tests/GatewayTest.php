<?php

namespace Omnipay\RedirectDummy;

use Omnipay\RedirectDummy\Gateway;
use Omnipay\RedirectDummy\Message\PurchaseRequest;
use Omnipay\RedirectDummy\Message\PurchaseResponse;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize([
            'url_gateway' => 'http://localhost',
        ]);
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'amount' => '12.00',
            'description' => 'Test purchase',
            'transactionId' => 1,
            'notifyUrl' => 'http://localhost',
        ]);
        //$response = $request->getResponse();

        $this->assertInstanceOf(PurchaseRequest::class, $request);
        $this->assertSame('12.00', $request->getAmount());

        $response = $request->sendData($request->getData());

        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('/payment', $response->getRedirectUrl());
        var_dump($response->getData());
    }
}