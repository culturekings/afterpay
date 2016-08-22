<?php
namespace CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Authorization;
use CultureKings\Afterpay\Model\Configuration as ConfigurationModel;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Psr\Log\LoggerInterface;

/**
 * Class Configuration
 * @package CultureKings\Afterpay\Service
 */
class Configuration
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct(
        Client $client,
        Serializer $serializer
    ) {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function get(Authorization $authorization)
    {
        $res = $this->client->request('GET', '/v1/configuration', [
            'auth' => [$authorization->getMerchantId(), $authorization->getSecret()],
        ]);

        $body = $res->getBody()->getContents();

        return $this->serializer->deserialize($body, sprintf('array<%s>', ConfigurationModel::class), 'json');
    }
}
