<?php

namespace Omnipay\BankTransfer\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletedPurchaseResponse extends AbstractResponse
{
    public function getTransactionId()
    {
        return $this->getData()['transaction_id'];
    }

    public function getTransactionReference()
    {
        return now()->timestamp;
    }

    public function isSuccessful()
    {
        return (bool)$this->getData()['success'];
    }
}
