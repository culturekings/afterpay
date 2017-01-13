# InStore (POS) Api

## Usage

All the Afterpay API calls should be available via similar names in the main API factory.

### Activate Device

[Activate Docs](http://docs.afterpay.com.au/instore-api-v1.html#device-activation)

```php
$authorization = new \CultureKings\Afterpay\Model\InStore\Authorization(
    \CultureKings\Afterpay\Model\InStore\Authorization::SANDBOX_URI
);

$device = \CultureKings\Afterpay\Factory\InStoreApi::device($authorization)->activate();
```

## Exceptions

If a call to Afterpay fails, a `\CultureKings\Afterpay\Exception\ApiException` will be thrown and the error message can be retrieved via the `getErrorResponse` method.
