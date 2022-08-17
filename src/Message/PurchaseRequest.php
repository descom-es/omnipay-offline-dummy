<?php

namespace Omnipay\RedirectDummy\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * PayFast Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    public function getUrlGateway()
    {
        return $this->getParameter('url_gateway');
    }

    public function setUrlGateway($value)
    {
        return $this->setParameter('url_gateway', $value);
    }

    public function getData()
    {
        $this->validate(
            'amount',
            'description',
            'transactionId',
            'notifyUrl'
        );

        $data = array();
        $data['notify_url'] = $this->getNotifyUrl();
        $data['transaction_id'] = $this->getTransactionId();
        $data['amount'] = $this->getAmount();

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data, $this->getEndpoint().'/payment');
    }

    public function getEndpoint()
    {
        return ''; //$this->getUrlGateway();
    }
}