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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}