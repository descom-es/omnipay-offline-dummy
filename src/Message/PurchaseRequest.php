<?php

namespace Omnipay\RedirectDummy\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\RedirectDummy\App\App;

/**
 * PayFast Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
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
        return $this->response = new PurchaseResponse($this, $data, $this->getEndpoint());
    }

    public function getEndpoint()
    {
        return App::url('/payment');
    }
}