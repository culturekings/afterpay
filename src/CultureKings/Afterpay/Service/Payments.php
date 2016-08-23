<?php
namespace CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Model\PaymentsList;
use CultureKings\Afterpay\Traits\AuthorizationTrait;
use CultureKings\Afterpay\Traits\ClientTrait;
use CultureKings\Afterpay\Traits\SerializerTrait;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

/**
 * Class Payments
 *
 * @package CultureKings\Afterpay\Service
 */
class Payments
{
    use ClientTrait;
    use AuthorizationTrait;
    use SerializerTrait;

    /**
     * Payments constructor.
     * @param Client              $client
     * @param Authorization       $authorization
     * @param SerializerInterface $serializer
     */
    public function __construct(
        Client $client,
        Authorization $authorization,
        SerializerInterface $serializer
    ) {
        $this->setClient($client);
        $this->setAuthorization($authorization);
        $this->setSerializer($serializer);
    }

    /**
     * @return array|\JMS\Serializer\scalar|object
     */
    public function list()
    {
        $result = $this->getClient()->get(
            'payments',
            [
                'auth' => [
                    $this->getAuthorization()->getMerchantId(),
                    $this->getAuthorization()->getSecret(),
                ],
            ]
        );

        return $this->getSerializer()->deserialize(
            $result->getBody()->getContents(),
            PaymentsList::class,
            'json'
        );
    }
}
