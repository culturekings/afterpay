<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\InStore\Authorization;
use CultureKings\Afterpay\Service;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerInterface;

/**
 * Class InStoreApi
 * @package CultureKings\Afterpay\Factory
 */
class InStoreApi extends Api
{
    /**
     * @param Authorization            $authorization
     * @param ClientInterface|null     $client
     * @param SerializerInterface|null $serializer
     *
     * @return Service\InStore\Device
     */
    public static function device(
        Authorization $authorization,
        ClientInterface $client = null,
        SerializerInterface $serializer = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $authorization->getEndpoint() ]);
        $afterpaySerializer = $serializer ?: SerializerFactory::getSerializer();

        return new Service\InStore\Device($authorization, $afterpayClient, $afterpaySerializer);
    }

    /**
     * @param Authorization            $authorization
     * @param Client|null              $client
     * @param SerializerInterface|null $serializer
     *
     * @return Service\InStore\PreApproval
     */
    public static function preapproval(
        Authorization $authorization,
        Client $client = null,
        SerializerInterface $serializer = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $authorization->getEndpoint() ]);
        $afterpaySerializer = $serializer ?: SerializerFactory::getSerializer();

        return new Service\InStore\PreApproval($authorization, $afterpayClient, $afterpaySerializer);
    }

    /**
     * @param Authorization            $authorization
     * @param Client|null              $client
     * @param SerializerInterface|null $serializer
     *
     * @return Service\InStore\Order
     */
    public static function order(
        Authorization $authorization,
        Client $client = null,
        SerializerInterface $serializer = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $authorization->getEndpoint() ]);
        $afterpaySerializer = $serializer ?: SerializerFactory::getSerializer();

        return new Service\InStore\Order($authorization, $afterpayClient, $afterpaySerializer);
    }

    /**
     * @param Authorization            $authorization
     * @param Client|null              $client
     * @param SerializerInterface|null $serializer
     *
     * @return Service\InStore\Refund
     */
    public static function refund(
        Authorization $authorization,
        Client $client = null,
        SerializerInterface $serializer = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $authorization->getEndpoint() ]);
        $afterpaySerializer = $serializer ?: SerializerFactory::getSerializer();

        return new Service\InStore\Refund($authorization, $afterpayClient, $afterpaySerializer);
    }

    /**
     * @param Authorization            $authorization
     * @param Client|null              $client
     * @param SerializerInterface|null $serializer
     *
     * @return Service\InStore\Customer
     */
    public static function customer(
        Authorization $authorization,
        Client $client = null,
        SerializerInterface $serializer = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $authorization->getEndpoint() ]);
        $afterpaySerializer = $serializer ?: SerializerFactory::getSerializer();

        return new Service\InStore\Customer($authorization, $afterpayClient, $afterpaySerializer);
    }

    /**
     * @param string               $endpoint
     * @param ClientInterface|null $client
     *
     * @return Service\InStore\Ping
     */
    public static function ping(
        $endpoint,
        ClientInterface $client = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $endpoint ]);

        return new Service\InStore\Ping($afterpayClient);
    }
}
