<?php

namespace Omnipay\RedirectDummy\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\RedirectDummy\App\App;

/**
 * PayFast Purchase Request
 */
class CompletedPurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return [
            'transaction_id' => $this->getTransactionId(),
            'amount' => $this->getAmount(),
            'success' => App::STATUS_SUCCESS === $this->getStatus(),
        ];
    }

    public function sendData($data)
    {
        return $this->response = new CompletedPurchaseResponse($this, $data);
    }
}