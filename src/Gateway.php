<?php

namespace Omnipay\OfflineDummy;

use Omnipay\Common\AbstractGateway;
use Omnipay\OfflineDummy\Message\CompletedPurchaseRequest;
use Omnipay\OfflineDummy\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'OfflineDummy';
    }

    public function getDefaultParameters()
    {
        return [
            'url_notify' => 'http://localhost',
            'url_return' => 'http://localhost',
        ];
    }

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

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(CompletedPurchaseRequest::class, $parameters);
    }
}
