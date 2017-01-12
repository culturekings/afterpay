# UPGRADING

## v0.1.5 -> v1.0.0

* Guzzle has been updated to require guzzlehttp/guzzle 6.0
* Due to the addition of InStore API the namespaces have changed for the following files to provide seperation between the different APIs
    * `CultureKings\Afterpay\Service\Configuration` -> `CultureKings\Afterpay\Service\Merchant\Configuration`
    * `CultureKings\Afterpay\Service\Orders` -> `CultureKings\Afterpay\Service\Merchant\Orders`
    * `CultureKings\Afterpay\Service\Payments` -> `CultureKings\Afterpay\Service\Merchant\Payments`
* `CultureKings\Afterpay\Factory\Api` marked as DEPRECATED. Use `CultureKings\Afterpay\Factory\MerchantApi` instead
