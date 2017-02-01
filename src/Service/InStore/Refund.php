<?php
namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use JMS\Serializer\SerializerInterface;

/**
 * Class Refund
 * @package CultureKings\Afterpay\Service\InStore
 */
class Refund
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
     * @param Model\InStore\Refund $refund
     * @param HandlerStack|null    $stack
     *
     * @return array|\JMS\Serializer\scalar|object
     */
    public function create(Model\InStore\Refund $refund, HandlerStack $stack = null)
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
                    $refund,
                    'json'
                ),
            ];
            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $result = $this->getClient()->post('refunds', $params);

            return $this->getSerializer()->deserialize(
                (string) $result->getBody(),
                Model\InStore\Refund::class,
                'json'
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                ),
                $e
            );
        }
    }

    /**
     * @param Model\InStore\Reversal $reversal
     * @param HandlerStack|null      $stack
     *
     * @return array|\JMS\Serializer\scalar|Model\InStore\Reversal
     */
    public function reverse(Model\InStore\Reversal $reversal, HandlerStack $stack = null)
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
                    $reversal,
                    'json'
                ),
            ];
            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $result = $this->getClient()->post('refunds/reverse', $params);

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
                ),
                $e
            );
        }
    }
}
