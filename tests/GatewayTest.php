<?php

namespace Omnipay\RedirectDummy;

use Omnipay\Common\Http\Client;
use Omnipay\RedirectDummy\Gateway;
use Omnipay\RedirectDummy\Message\PurchaseRequest;
use Omnipay\RedirectDummy\Message\PurchaseResponse;
use Omnipay\RedirectDummy\Tests\TestCase;
use Omnipay\Tests\GatewayTestCase;
use Symfony\Component\HttpFoundation\Request;

class GatewayTest extends TestCase
{
    private Gateway $gateway;

    private function getHttpClient()
    {
        return new Client();
    }

    private function getHttpRequest()
    {
        return Request::createFromGlobals();
    }

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
            'notifyUrl' => 'http://localhost:8080/gateway/notify',
        ]);

        $this->assertInstanceOf(PurchaseRequest::class, $request);
        $this->assertSame('12.00', $request->getAmount());

        $response = $request->sendData($request->getData());

        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('http://localhost/payment', $response->getRedirectUrl());
        $this->assertEquals('http://localhost:8080/gateway/notify', $response->getData()['notify_url']);
    }
}