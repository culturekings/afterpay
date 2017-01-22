<?php

namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;
use JMS\Serializer\SerializerInterface;

/**
 * Class Order
 * @package CultureKings\Afterpay\Service\InStore
 */
class Order
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
     * @param Model\InStore\Order $order
     * @param HandlerStack|null   $stack
     *
     * @return array|\JMS\Serializer\scalar|object
     */
    public function create(Model\InStore\Order $order, HandlerStack $stack = null)
    {
        try {
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->getAuthorization()->getDeviceToken()),
                    'Operator' => $this->getAuthorization()->getOperator(),
                    'User-Agent' => $this->getAuthorization()->getUserAgent()
                ],
                'body' => $this->getSerializer()->serialize(
                    $order,
                    'json'
                ),
            ];
            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $result = $this->getClient()->post('orders', $params);

            return $this->getSerializer()->deserialize(
                (string) $result->getBody(),
                Model\InStore\Order::class,
                'json'
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }
    }

    /**
     * @param Model\InStore\Reversal $orderReversal
     * @param HandlerStack|null      $stack
     *
     * @return array|\JMS\Serializer\scalar|object
     */
    public function reverse(Model\InStore\Reversal $orderReversal, HandlerStack $stack = null)
    {
        try {
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->getAuthorization()->getDeviceToken()),
                    'Operator' => $this->getAuthorization()->getOperator(),
                    'User-Agent' => $this->getAuthorization()->getUserAgent()
                ],
                'body' => $this->getSerializer()->serialize(
                    $orderReversal,
                    'json'
                ),
            ];
            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $result = $this->getClient()->post('orders/reverse', $params);

            return $this->getSerializer()->deserialize(
                (string) $result->getBody(),
                Model\InStore\Reversal::class,
                'json'
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }
    }
}
