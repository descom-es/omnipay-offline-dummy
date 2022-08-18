<?php

namespace Omnipay\RedirectDummy;

use Omnipay\Common\AbstractGateway;
use Omnipay\RedirectDummy\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'RedirectDummy';
    }

    public function getDefaultParameters()
    {
        return [
            'token' => '',
        ];
    }

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}