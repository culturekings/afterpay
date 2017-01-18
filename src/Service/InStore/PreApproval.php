<?php

namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

/**
 * Class PreApproval
 * @package CultureKings\Afterpay\Service\InStore
 */
class PreApproval
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
     * @param Model\InStore\PreApproval $preApproval
     * @param HandlerStack|null         $stack
     *
     * @return array|\JMS\Serializer\scalar|object
     */
    public function enquiry(Model\InStore\PreApproval $preApproval, HandlerStack $stack = null)
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
                    $preApproval,
                    'json',
                    SerializationContext::create()->setGroups(['preApproval'])
                ),
            ];
            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $result = $this->getClient()->post('preapprovals/enquire', $params);

            return $this->getSerializer()->deserialize(
                (string) $result->getBody()->getContents(),
                Model\InStore\Device::class,
                'json'
            );
        } catch (ClientException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    $e->getResponse()->getBody()->getContents(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }
    }
}
