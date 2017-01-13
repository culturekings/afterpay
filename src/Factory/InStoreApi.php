<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\InStore\Authorization;
use CultureKings\Afterpay\Service\InStore\Device as DeviceService;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerInterface;

/**
 * Class InStoreApi
 * @package CultureKings\Afterpay\Factory
 */
class InStoreApi
{
    /**
     * @param Authorization            $authorization
     * @param ClientInterface|null     $client
     * @param SerializerInterface|null $serializer
     *
     * @return DeviceService
     */
    public static function device(
        Authorization $authorization,
        ClientInterface $client = null,
        SerializerInterface $serializer = null
    ) {

        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client(['base_uri' => $authorization->getEndpoint()]);
        $afterpaySerializer = $serializer ?: SerializerFactory::getSerializer();

        return new DeviceService($authorization, $afterpayClient, $afterpaySerializer);
    }

    /**
     * @param Authorization $authorization
     * @param Client|null   $client
     */
    public static function preapproval(
        Authorization $authorization,
        Client $client = null
    ) {
        echo 'here';
    }

    /**
     * @param Authorization $authorization
     * @param Client|null   $client
     */
    public static function order(
        Authorization $authorization,
        Client $client = null
    ) {
        echo 'here';
    }
}
