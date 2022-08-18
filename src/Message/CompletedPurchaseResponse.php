<?php

namespace Omnipay\OfflineDummy\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletedPurchaseResponse extends AbstractResponse
{
    public function getTransactionReference()
    {
        return now()->timestamp;
    }

    public function isSuccessful()
    {
        return (bool)$this->getData()['success'];
    }
}
