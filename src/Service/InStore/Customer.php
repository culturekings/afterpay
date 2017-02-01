<?php
namespace CultureKings\Afterpay\Service\InStore;


use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;
use JMS\Serializer\SerializerInterface;

/**
 * Class Customer
 * @package CultureKings\Afterpay\Service\InStore
 */
class Customer
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
     * @param Model\InStore\Invite $invite
     * @param HandlerStack|null    $stack
     *
     * @return bool
     */
    public function invite(Model\InStore\Invite $invite, HandlerStack $stack = null)
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
                'body' => $this->getSerializer()->serialize($invite, 'json'),
            ];

            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $this->getClient()->post(
                'invite',
                $params
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    ErrorResponse::class,
                    'json'
                ),
                $e
            );
        }

        return true;
    }
}
