<?php

namespace Omnipay\OfflineDummy\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\OfflineDummy\App\App;

/**
 * PayFast Purchase Request
 */
class CompletedPurchaseRequest extends AbstractRequest
{
    public function getUrlNotify()
    {
        return $this->getParameter('url_notify');
    }

    public function setUrlNotify($value)
    {
        return $this->setParameter('url_notify', $value);
    }

    public function getUrlReturn()
    {
        return $this->getParameter('url_return');
    }

    public function setUrlReturn($value)
    {
        return $this->setParameter('url_return', $value);
    }

    public function getStatus()
    {
        return $this->getParameter('status');
    }

    public function setStatus($value)
    {
        return $this->setParameter('status', $value);
    }

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
