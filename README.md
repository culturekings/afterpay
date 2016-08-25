[AfterPay API](https://culturekings.github.io/afterpay/)
=======================

PHP library to interface with the [Afterpay API](http://docs.afterpay.com.au/) 

[![Coverage Status](https://coveralls.io/repos/github/culturekings/afterpay/badge.svg)](https://coveralls.io/github/culturekings/afterpay)
[![CircleCI](https://img.shields.io/circleci/project/culturekings/afterpay.svg?style=svg)](https://img.shields.io/circleci/project/culturekings/afterpay.svg?style=svg)
[![Scrutinizer](https://scrutinizer-ci.com/g/culturekings/afterpay/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/culturekings/afterpay/badges/quality-score.png?b=master)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/b9b910ea-dc47-4459-a7b1-ff9da76edebd.svg)](https://img.shields.io/sensiolabs/i/b9b910ea-dc47-4459-a7b1-ff9da76edebd.svg)

## Installation

The recommended way to install is via [Composer](http://getcomposer.org).


```bash
composer require culturekings/afterpay
```

Don't forget to include Composer's autoloader if you haven't already:

```php
require 'vendor/autoload.php';
```

## Usage

All the Afterpay API calls should be available via similar names in the main API factory.

### Get Configuration

[Get Configuration Docs](http://docs.afterpay.com.au/merchant-api-v1.html#get-configuration)

```php
$authorization = new \CultureKings\Afterpay\Authorization(
    \CultureKings\Afterpay\Model\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$configuration = \CultureKings\Afterpay\Factory\Api::configuration($authorization)->get()
```

### List Payments

[List Payments Docs](http://docs.afterpay.com.au/merchant-api-v1.html#list-payments)

```php
$authorization = new \CultureKings\Afterpay\Authorization(
    \CultureKings\Afterpay\Model\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$payments = \CultureKings\Afterpay\Factory\Api::payments($auth)->listPayments(
    [
        'fromCreatedDate' => '2016-01-01T00:00:00.000Z',
        'limit' => 1
    ]
);
```

### Create Order

[Create Order Docs](http://docs.afterpay.com.au/merchant-api-v1.html#create-order)

```
$consumer = new \CultureKings\Afterpay\Model\Consumer();
$consumer->setEmail('john.doe@culturekings.com.au');
$consumer->setGivenNames('John');
$consumer->setSurname('Doe');
$consumer->setPhoneNumber('0534242323');

$merchantOptions = new \CultureKings\Afterpay\Model\MerchantOptions();
$merchantOptions->setRedirectConfirmUrl('https://www.merchant.com/confirm');
$merchantOptions->setRedirectCancelUrl('https://www.merchant.com/cancel');

$totalAmount = new \CultureKings\Afterpay\Model\Money();
$totalAmount->setAmount(mt_rand(1, 300));
$totalAmount->setCurrency('AUD');

$orderDetails = new \CultureKings\Afterpay\Model\OrderDetails();
$orderDetails->setConsumer($consumer);
$orderDetails->setMerchant($merchantOptions);
$orderDetails->setTotalAmount($totalAmount);

$orderToken  = \CultureKings\Afterpay\Factory\Api::orders($auth)->create($orderDetails);
```

### Get Order

[Get Order Docs](http://docs.afterpay.com.au/merchant-api-v1.html#get-order)

```$order = \CultureKings\Afterpay\Factory\Api::orders($auth)->get($orderToken->getToken());```

## Exceptions

If a call to Afterpay fails, a `\CultureKings\Afterpay\Exception\ApiException` will be thrown and the error message can be retrieved via the `getErrorResponse` method.

## Special Thanks

[JMS Serializer](https://github.com/schmittjoh/serializer)

[Guzzle](https://github.com/guzzle/guzzle)

