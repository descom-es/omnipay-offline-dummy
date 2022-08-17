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
            'url_gateway' => '',
        ];
    }

    public function getUrlGateway()
    {
        return $this->getParameter('url_gateway');
    }

    public function setUrlGateway($value)
    {
        return $this->setParameter('url_gateway', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}