# Omnipay:: Bank transfer

Omnipay bank Transfer Gateway


## Instalation

```sh
composer require descom/omnipay-bank-transfer
```

## Basic Usage

### Create purchase request

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('BankTransfer');

$request = $gateway->purchase([
                'amount' => '12.00',
                'description' => 'Test purchase',
                'transactionId' => 1,
                'url_notify' => 'http://example.com/payment/notify',
                'url_return' => 'http://example.com/payment/return',
            ])->send();

$response->redirect();
```
