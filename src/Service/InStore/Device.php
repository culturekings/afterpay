<?php
namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

/**
 * Class Device
 * @package CultureKings\Afterpay\Service\InStore
 */
class Device
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
     * @param Model\InStore\Device $device
     * @param HandlerStack|null    $stack
     *
     * @return array|\JMS\Serializer\scalar|Model\InStore\Device
     */
    public function activate(Model\InStore\Device $device, HandlerStack $stack = null)
    {
        try {
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => $this->getSerializer()->serialize(
                    $device,
                    'json',
                    SerializationContext::create()->setGroups(['activateDevice'])
                ),
            ];
            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $result = $this->getClient()->post('devices/activate', $params);

            return $this->getSerializer()->deserialize(
                (string) $result->getBody(),
                Model\InStore\Device::class,
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
     * @param Model\InStore\Device $device
     * @param HandlerStack|null    $stack
     *
     * @return array|\JMS\Serializer\scalar|Model\InStore\DeviceToken
     */
    public function createToken(Model\InStore\Device $device, HandlerStack $stack = null)
    {
        try {
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => $this->getSerializer()->serialize(
                    $device,
                    'json',
                    SerializationContext::create()->setGroups(['createToken'])
                ),
            ];
            if ($stack !== null) {
                $params['handler'] = $stack;
            }

            $result = $this->getClient()->post(sprintf('devices/%d/token', $device->getDeviceId()), $params);

            return $this->getSerializer()->deserialize(
                (string) $result->getBody(),
                Model\InStore\DeviceToken::class,
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
