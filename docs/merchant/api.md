# Merchant API Documentation

## Usage

All the Afterpay API calls should be available via similar names in the main API factory.

### Get Configuration

[Get Configuration Docs](http://docs.afterpay.com.au/merchant-api-v1.html#get-configuration)

```php
$authorization = new \CultureKings\Afterpay\Model\Merchant\Authorization(
    \CultureKings\Afterpay\Model\Merchant\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$configuration = \CultureKings\Afterpay\Factory\MerchantApi::configuration($authorization)->get();
```

### List Payments

[List Payments Docs](http://docs.afterpay.com.au/merchant-api-v1.html#list-payments)

```php
$authorization = new \CultureKings\Afterpay\Model\Merchant\Authorization(
    \CultureKings\Afterpay\Model\Merchant\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$payments = \CultureKings\Afterpay\Factory\MerchantApi::payments($authorization)->listPayments(
    [
        'fromCreatedDate' => '2016-01-01T00:00:00.000Z',
        'limit' => 1
    ]
);
```

### Get Payment

[Get Payment Docs](http://docs.afterpay.com.au/merchant-api-v1.html#get-payment)

```php
$authorization = new \CultureKings\Afterpay\Model\Merchant\Authorization(
    \CultureKings\Afterpay\Model\Merchant\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$payment = \CultureKings\Afterpay\Factory\MerchantApi::payments($authorization)->get(
    PAYMENT_ID
);
```

### Get Payment By Token

[Get Payment Docs](http://docs.afterpay.com.au/merchant-api-v1.html#get-payment)

```php
$authorization = new \CultureKings\Afterpay\Model\Merchant\Authorization(
    \CultureKings\Afterpay\Model\Merchant\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$payment = \CultureKings\Afterpay\Factory\MerchantApi::payments($authorization)->getByToken(
    ORDER_TOKEN
);
```

### Authorise Payment

[Authorise Payment Docs](http://docs.afterpay.com.au/merchant-api-v1.html#authorise-payment)

```php
$authorization = new \CultureKings\Afterpay\Model\Merchant\Authorization(
    \CultureKings\Afterpay\Model\Merchant\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$payment = \CultureKings\Afterpay\Factory\MerchantApi::payments($authorization)->authorise(
    ORDER_TOKEN,
    MERCHANT_REFERENCE,
    WEBHOOK_EVENT_URL
);
```

### Capture Payment

[Capture Payment Docs](http://docs.afterpay.com.au/merchant-api-v1.html#direct-capture-payment)

```php
$authorization = new \CultureKings\Afterpay\Model\Merchant\Authorization(
    \CultureKings\Afterpay\Model\Merchant\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$payment = \CultureKings\Afterpay\Factory\MerchantApi::payments($authorization)->capture(
    ORDER_TOKEN,
    MERCHANT_REFERENCE,
    WEBHOOK_EVENT_URL
);
```

### Void Payment

[Void Payment Docs](http://docs.afterpay.com.au/merchant-api-v1.html#void-payment)

```php
$authorization = new \CultureKings\Afterpay\Model\Merchant\Authorization(
    \CultureKings\Afterpay\Model\Merchant\Authorization::SANDBOX_URI,
    YOUR_MERCHANT_ID,
    YOUR_SECRET_KEY
);

$payment = \CultureKings\Afterpay\Factory\MerchantApi::payments($authorization)->void(
    PAYMENT_ID
);
```

### Create Order

[Create Order Docs](http://docs.afterpay.com.au/merchant-api-v1.html#create-order)

```php
$consumer = new \CultureKings\Afterpay\Model\Merchant\Consumer();
$consumer->setEmail('john.doe@culturekings.com.au');
$consumer->setGivenNames('John');
$consumer->setSurname('Doe');
$consumer->setPhoneNumber('0534242323');

$merchantOptions = new \CultureKings\Afterpay\Model\Merchant\MerchantOptions();
$merchantOptions->setRedirectConfirmUrl('https://www.merchant.com/confirm');
$merchantOptions->setRedirectCancelUrl('https://www.merchant.com/cancel');

$totalAmount = new \CultureKings\Afterpay\Model\Money();
$totalAmount->setAmount(mt_rand(1, 300));
$totalAmount->setCurrency('AUD');

$orderDetails = new \CultureKings\Afterpay\Model\Merchant\OrderDetails();
$orderDetails->setConsumer($consumer);
$orderDetails->setMerchant($merchantOptions);
$orderDetails->setTotalAmount($totalAmount);

$orderToken  = \CultureKings\Afterpay\Factory\MerchantApi::orders($authorization)->create($orderDetails);
```

### Get Order

[Get Order Docs](http://docs.afterpay.com.au/merchant-api-v1.html#get-order)

```php
$order = \CultureKings\Afterpay\Factory\MerchantApi::orders($authorization)->get($orderToken->getToken());
```

## Exceptions

If a call to Afterpay fails, a `\CultureKings\Afterpay\Exception\ApiException` will be thrown and the error message can be retrieved via the `getErrorResponse` method.
