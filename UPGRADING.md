# UPGRADING

## v0.1.5 -> v1.0.0

* Guzzle has been updated to require guzzlehttp/guzzle 6.0
* Due to the addition of InStore API the namespaces have changed for the following files to provide seperation between the different APIs
    * `CultureKings\Afterpay\Service\Configuration` -> `CultureKings\Afterpay\Service\Merchant\Configuration`
    * `CultureKings\Afterpay\Service\Orders` -> `CultureKings\Afterpay\Service\Merchant\Orders`
    * `CultureKings\Afterpay\Service\Payments` -> `CultureKings\Afterpay\Service\Merchant\Payments`
    * `CultureKings\Afterpay\Model\Configuration` -> `CultureKings\Afterpay\Model\Merchant\Configuration`
    * `CultureKings\Afterpay\Model\Consumer` -> `CultureKings\Afterpay\Model\Merchant\Consumer`
    * `CultureKings\Afterpay\Model\Contact` -> `CultureKings\Afterpay\Model\Merchant\Contact`
    * `CultureKings\Afterpay\Model\Discount` -> `CultureKings\Afterpay\Model\Merchant\Discount`
    * `CultureKings\Afterpay\Model\MerchantOptions` -> `CultureKings\Afterpay\Model\Merchant\MerchantOptions`
    * `CultureKings\Afterpay\Model\OrderDetails` -> `CultureKings\Afterpay\Model\Merchant\OrderDetails`
    * `CultureKings\Afterpay\Model\OrderToken` -> `CultureKings\Afterpay\Model\Merchant\OrderToken`
    * `CultureKings\Afterpay\Model\Payment` -> `CultureKings\Afterpay\Model\Merchant\Payment`
    * `CultureKings\Afterpay\Model\PaymentEvent` -> `CultureKings\Afterpay\Model\Merchant\PaymentEvent`
    * `CultureKings\Afterpay\Model\PaymentsList` -> `CultureKings\Afterpay\Model\Merchant\PaymentsList`
    * `CultureKings\Afterpay\Model\Refund` -> `CultureKings\Afterpay\Model\Merchant\Refund`
    * `CultureKings\Afterpay\Model\ShippingCourier` -> `CultureKings\Afterpay\Model\Merchant\ShippingCourier`
* `CultureKings\Afterpay\Factory\Api` marked as DEPRECATED. Use `CultureKings\Afterpay\Factory\MerchantApi` instead
