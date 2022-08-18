# Omnipay:: Offline dummy

Omnipay Offline Dummy Gateway for testing

## Instalation

```sh
composer require descom/omnipay-offline-dummy
```

## Basic Usage

### Create purchase request

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('OfflineDummy');

$gateway->initialize([
    'url_notify' => 'http://example.com/payment/notify',
    'url_return' => 'http://example.com/payment/return',
]);

$request = $gateway->purchase([
                'amount' => '12.00',
                'description' => 'Test purchase',
                'transactionId' => 1,
            ])->send();

$response->redirect();
```