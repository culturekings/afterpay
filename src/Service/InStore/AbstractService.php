<?php
namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use JMS\Serializer\SerializerInterface;

/**
 * Class AbstractService
 * @package CultureKings\Afterpay\Service\InStore
 */
abstract class AbstractService
{
    use Traits\ClientTrait;
    use Traits\AuthorizationTrait;
    use Traits\SerializerTrait;

    /**
     * Device constructor.
     *
     * @param Model\InStore\Authorization $auth
     * @param Client                      $client
     * @param SerializerInterface         $serializer
     */
    public function __construct(Model\InStore\Authorization $auth, Client $client, SerializerInterface $serializer)
    {
        $this->setAuthorization($auth);
        $this->setClient($client);
        $this->setSerializer($serializer);
    }

    /**
     * @param object|array      $model
     * @param HandlerStack|null $stack
     *
     * @return array
     */
    protected function generateParams($model, HandlerStack $stack = null)
    {
        $params = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => sprintf('Bearer %s', $this->getAuthorization()->getDeviceToken()),
                'Operator' => $this->getAuthorization()->getOperator(),
                'User-Agent' => $this->getAuthorization()->getUserAgent(),
            ],
            'body' => $this->getSerializer()->serialize(
                $model,
                'json'
            ),
            'timeout' => Model\InStore\Authorization::REQUEST_TIMEOUT_SECONDS,
        ];
        if ($stack !== null) {
            $params['handler'] = $stack;
        }

        return $params;
    }
}
