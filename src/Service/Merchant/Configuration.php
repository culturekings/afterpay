<?php
namespace CultureKings\Afterpay\Service\Merchant;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Model\Configuration as ConfigurationModel;
use CultureKings\Afterpay\Traits\AuthorizationTrait;
use CultureKings\Afterpay\Traits\ClientTrait;
use CultureKings\Afterpay\Traits\SerializerTrait;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

/**
 * Class Configuration
 *
 * @package CultureKings\Afterpay\Service\Merchant
 */
class Configuration
{
    use AuthorizationTrait;
    use ClientTrait;
    use SerializerTrait;

    /**
     * Configuration constructor.
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
     * @return array
     */
    public function get()
    {
        $result = $this->getClient()->get(
            'configuration',
            [
                'auth' => [
                    $this->getAuthorization()->getMerchantId(),
                    $this->getAuthorization()->getSecret(),
                ],
            ]
        );

        return $this->getSerializer()->deserialize(
            $result->getBody()->getContents(),
            sprintf('array<%s>', ConfigurationModel::class),
            'json'
        );
    }
}
