# InStore (POS) Api

## Usage

All the Afterpay API calls should be available via similar names in the main API factory.

## Authorization

The majority of the Afterpay API is authorized using 
- a device token obtained from the create token api endpoint
- operator name
- user agent.
```php
$authorization = new \CultureKings\Afterpay\Model\InStore\Authorization(
    \CultureKings\Afterpay\Model\InStore\Authorization::SANDBOX_URI
);
$authorization->setDeviceToken($token->getToken());
$authorization->setOperator('Dante Hicks');
$authorization->setUserAgent('POS-XYZ/10.5');
```

However the [Activate Device](#activate-device) and [Create Device Token](#create-device-token) API calls do not need these values to be set.

### Device

#### Activate Device

[Activate Docs](http://docs.afterpay.com.au/instore-api-v1.html#device-activation)

```php
$device = new \CultureKings\Afterpay\Model\InStore\Device();
$device->setName(DEVICE_NAME);
$device->setSecret(DEVICE_SECRET);

$device = \CultureKings\Afterpay\Factory\InStoreApi::device($authorization)->activate($device);
```

#### Create Device Token

[Create Device Token Docs](http://docs.afterpay.com.au/instore-api-v1.html#create-token)

```php
$device = new \CultureKings\Afterpay\Model\InStore\Device();
$device->setDeviceId(DEVICE_ID);
$device->setKey(DEVICE_KEY);

$token = \CultureKings\Afterpay\Factory\InStoreApi::device($authorization)->createToken($device);
```

### Pre-approval

[Pre-Approval Docs](http://docs.afterpay.com.au/instore-api-v1.html#pre-approval)

```php
$code = BARCODE_VALUE;
$preApproval = \CultureKings\Afterpay\Factory\InStoreApi::preapproval($authorization)->enquiry($code);
```

### Order

#### Create

[Create Order Docs](http://docs.afterpay.com.au/instore-api-v1.html#create-order)

```php
try {
    $requestAt = new \DateTime('now');
    
    $money = new \CultureKings\Afterpay\Model\Money();
    $money->setAmount(5.00);
    $money->setCurrency('AUD');
    
    $order = new \CultureKings\Afterpay\Model\InStore\Order();
    $order->setAmount($money)
        ->setPreApprovalCode($code)
        ->setMerchantReference(MERCHANT_REFERENCE)
        ->setRequestId(A_UUID)
        ->setRequestedAt($requestAt);

    $item = new \CultureKings\Afterpay\Model\Item();
    $item->setName(ITEM_NAME);
    $item->setPrice($money);
    $item->setSKU(ITEM_SKU);
    $item->setQuantity(ITEM_QUANTITY);
    $order->addOrderItem($item);

    $order = \CultureKings\Afterpay\Factory\InStoreApi::order($authorization)->create($order);

    print_r($order);
} catch (\CultureKings\Afterpay\Exception\ApiException $e) {
    print_r($e->getErrorResponse());
}
```

### Reversal

[Reverse Order Docs](http://docs.afterpay.com.au/instore-api-v1.html#reverse-order)

```php
try {
    $requestAt = new \DateTime('now');

    $reversal = new \CultureKings\Afterpay\Model\InStore\Reversal();
    $reversal->setReversingRequestId(UUID);
    $reversal->setRequestedAt($requestAt);

    $res = \CultureKings\Afterpay\Factory\InStoreApi::order($authorization)->reverse($reversal);

    print_r($res);
} catch (\CultureKings\Afterpay\Exception\ApiException $e) {
    print_r($e->getErrorResponse());
}
```

## Refund

### Create

[Refund Order Docs](http://docs.afterpay.com.au/instore-api-v1.html#create-refund)

```php
try {
    $requestAt = new \DateTime('now');
    $money = new \CultureKings\Afterpay\Model\Money();
    $money->setAmount(3.00);
    $money->setCurrency('AUD');

    $refund = new \CultureKings\Afterpay\Model\InStore\Refund();
    $refund->setRequestId(REQUEST_ID);
    $refund->setAmount($money);
    $refund->setOrderId($order->getOrderId());
    $refund->setRequestedAt($requestAt);

    $res = \CultureKings\Afterpay\Factory\InStoreApi::refund($authorization)->create($refund);
    
    print_r($res);
} catch (\CultureKings\Afterpay\Exception\ApiException $e) {
    print_r($e->getErrorResponse());
}
```

### Reverse

[Referse Refund Docs](http://docs.afterpay.com.au/instore-api-v1.html#refund-reversal)

```php
try {
    $requestAt = new \DateTime('now');
    $reversal = new \CultureKings\Afterpay\Model\InStore\Reversal();
    $reversal->setReversingRequestId(REFUND_REQUEST_ID);
    $reversal->setRequestedAt($requestAt);

    $res = \CultureKings\Afterpay\Factory\InStoreApi::refund($authorization)->reverse($reversal);

    print_r($res);
} catch (\CultureKings\Afterpay\Exception\ApiException $e) {
    print_r($e->getErrorResponse());
}
```

## Exceptions

If a call to Afterpay fails, a `\CultureKings\Afterpay\Exception\ApiException` will be thrown and the error message can be retrieved via the `getErrorResponse` method.
