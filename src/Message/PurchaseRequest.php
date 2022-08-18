<?php

namespace Omnipay\OfflineDummy\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\OfflineDummy\App\App;

/**
 * PayFast Purchase Request
 */
class PurchaseRequest extends AbstractRequest
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

    public function getData()
    {
        $this->validate(
            'amount',
            'description',
            'transactionId'
        );

        $data = [];
        $data['notify_url'] = $this->getNotifyUrl();
        $data['transaction_id'] = $this->getTransactionId();
        $data['amount'] = $this->getAmount();
        $data['description'] = $this->getDescription();

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data, $this->getEndpoint());
    }

    public function getEndpoint()
    {
        return App::url('/payment');
    }
}
