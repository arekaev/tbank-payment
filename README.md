PHP-пакет для реализации приема платежей через т-Банк [Tbank Merchant API v2](https://www.tbank.ru/kassa/develop/).
За основу взят сторонний пакет, были исправлены ошибки в его работе и по мере необходимости он будет будет дорабатываться.

## Установка

```
1. В файл composer.json вашего проекта добавьте строку в блок require:
"arekaev/tbank-payment": "dev-main"

2. В блок repositories добавьте ссылку на данный репозиторий:
"repositories": [
        {
            "url": "https://github.com/arekaev/tbank-payment.git",
            "type": "vcs"
        }
    ],

3. Выполните composer install
```

## Как пользоваться

```php

добавьте в класс метода платежа (пример взят из проекта laravel):

use GuzzleHttp\Client;
use Arekaev\TbankPayment\TbankPayment;

$apiUrl = config('payment.tbank.test_mode') ? 'https://rest-api-test.tinkoff.ru/v2' : 'https://securepay.tinkoff.ru/v2';
$this->bankApi = new TbankPayment(new Client, config('payment.tbank.terminalKey'), config('payment.tbank.password'), $apiUrl);

```

## Создание платежа (на примере метода, который вызывается после сохранения заказа)

```php

use Arekaev\TbankPayment\Enums\Tax;
use Arekaev\TbankPayment\Enums\Taxation;
use Arekaev\TbankPayment\Exceptions\TbankException;
use Arekaev\TbankPayment\TbankPayment;
use Arekaev\TbankPayment\Values\Init;
use Arekaev\TbankPayment\Values\Item;
use Arekaev\TbankPayment\Values\Receipt;

$orderInfo = Order::where('order_id', $orderId)->firstOrFail();

if ($orderInfo->exists()) {
    $items = [];

    $orderInfo->items->map(function ($item) use (&$items) {
        $product = $item->product;

        $items[] = new Item($product->name, $item->quantity, $item->unit_price * $item->quantity * 100, $item->unit_price * 100, Tax::NONE);
    });

    $items[] = new Item('Услуга доставки', 1, $orderInfo->shipping_price * 100, $orderInfo->shipping_price * 100, Tax::NONE);

    $customerInfo = Customer::where('id', $orderInfo->customer_id)->first();

    $receipt = Receipt::make($items);
    $receipt->setEmail($customerInfo->email)
        ->setPhone($customerInfo->phone)
        ->setTaxation(Taxation::USN_INCOME_OUTCOME);

    $data = Init::make($orderId);
    $data->setAmount($orderInfo->total_price * 100)
        ->setSuccessURL(route('checkout.success', ['orderId' => $orderId]))
        ->setFailURL(route('checkout.fail', ['orderId' => $orderId]))
        ->setNotificationURL(route('checkout.notify', ['orderId' => $orderId]))
        ->setReceipt($receipt);

    $response = $this->bankApi->init($data);
    $paymentId = $response->getPaymentId();

    $orderInfo->payment_id = $paymentId;
    $orderInfo->save();

    return $response->getPaymentUrl();
} else {
    throw new TbankException('Order not found');
}

```

## Получение статуса платежа

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
