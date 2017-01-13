<?php
namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
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
     * @param ClientInterface             $client
     * @param SerializerInterface         $serializer
     */
    public function __construct(Model\InStore\Authorization $auth, ClientInterface $client, SerializerInterface $serializer)
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
            $result = $this->getClient()->post('devices/activate', [
                'body' => $this->getSerializer()->serialize($device, 'json'),
            ]);

            return $this->getSerializer()->deserialize(
                $result->getBody()->getContents(),
                sprintf('array<%s>', Model\InStore\Device::class),
                'json'
            );
        } catch (ClientException $clientException) {

        }
    }
}
