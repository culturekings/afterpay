<?php
namespace CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Authorization;
use CultureKings\Afterpay\ClientTrait;
use CultureKings\Afterpay\Model\Configuration as ConfigurationModel;
use CultureKings\Afterpay\SerializerTrait;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;

/**
 * Class Configuration
 *
 * @package CultureKings\Afterpay\Service
 */
class Configuration
{
    use ClientTrait;
    use SerializerTrait;

    /**
     * Configuration constructor.
     *
     * @param Client     $client
     * @param Serializer $serializer
     */
    public function __construct(
        Client $client,
        Serializer $serializer
    ) {
        $this->setClient($client);
        $this->setSerializer($serializer);
    }

    /**
     * @param Authorization $authorization
     * @return \CultureKings\Afterpay\Model\Configuration[]
     */
    public function get(Authorization $authorization)
    {
        $res = $this->getClient()->get(
            '/v1/configuration',
            [
                'auth' => [
                    $authorization->getMerchantId(),
                    $authorization->getSecret(),
                ],
            ]
        );

        return $this->getSerializer()->deserialize(
            $res->getBody()->getContents(),
            sprintf('array<%s>', ConfigurationModel::class),
            'json'
        );
    }
}
