# Tbank Cashier

PHP implementation of [Tbank Merchant API v2](https://www.tbank.ru/kassa/develop/).

## Installation

```
composer require arekaev/tinkoff
```

## How to use

```php
use GuzzleHttp\Client;
use Arekaev\TbankPayment\TbankPayment;

$client = new Client();
$terminalKey = 'your-terminal-key';
$password = 'your-password';

$bankApi = new TbankPayment($client, $terminalKey, $password);
```

## Creating a payment

```php
use Arekaev\TbankPayment\Values\Init;

$orderId = 'your-order-id';
$data = new Init($orderId);
$data
    ->setAmount(1000)
    ->setSuccessURL("https://site.com/invoice/$orderId/success");

$response = $bankApi->init($data);

$paymentId = $response->getPaymentId();

redirect($response->getPaymentURL());

```

## Checking payment

```php
use Arekaev\TbankPayment\Values\GetState;
use Arekaev\TbankPayment\Enums\PaymentStatus;

$data = GetState::make($paymentId);

$response = $bankApi->getState($data);

if ($response->getStatus() === PaymentStatus::CONFIRMED) {
    // after success actions
} else {
    // after failure actions
}
```
