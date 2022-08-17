<?php

namespace Omnipay\RedirectDummy;

use Omnipay\Tests\GatewayTestCase;

class OmnipayTest extends GatewayTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize();
    }
}