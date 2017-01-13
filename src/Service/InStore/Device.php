<?php
namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
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
     *
     * @return array|\JMS\Serializer\scalar|object
     */
    public function activate(Model\InStore\Device $device)
    {
        try {
            $stack = HandlerStack::create();

            $stack->push(Middleware::tap(function (Request $request) {
                dump((string) $request->getBody());
            }));

            $result = $this->getClient()->post('devices/activate', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => $this->getSerializer()->serialize($device, 'json'),
                'handler' => $stack,
            ]);

            return $this->getSerializer()->deserialize(
                $result->getBody()->getContents(),
                sprintf('array<%s>', Model\InStore\Device::class),
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

    /**
     * @return array|\JMS\Serializer\scalar|object
     */
    public function createToken()
    {
        try {
            $result = $this->getClient()->post('devices/123/token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => $this->getSerializer()->serialize($device, 'json'),
            ]);

            return $this->getSerializer()->deserialize(
                $result->getBody()->getContents(),
                sprintf('array<%s>', Model\InStore\Device::class),
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
