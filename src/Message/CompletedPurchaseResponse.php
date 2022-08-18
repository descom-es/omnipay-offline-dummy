<?php

namespace Omnipay\OfflineDummy\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletedPurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return (bool)$this->getData()['success'];
    }
}