<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\Merchant\Authorization;
use CultureKings\Afterpay\Service\Merchant\Configuration as ConfigurationService;
use CultureKings\Afterpay\Service\Merchant\Payments as PaymentsService;
use CultureKings\Afterpay\Service\Merchant\Orders as OrdersService;
use CultureKings\Afterpay\Service\Merchant\Ping as PingService;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerInterface;

/**
 * Class MerchantApi
 * @package CultureKings\Afterpay\Factory
 */
class MerchantApi extends Api
{
    /**
     * @param Authorization            $authorization
     * @param Client|null              $client
     * @param SerializerInterface|null $serializer
     * @return ConfigurationService
     */
    public static function configuration(
        Authorization $authorization,
        Client $client = null,
        SerializerInterface $serializer = null
    ) {

        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ? : new Client([ 'base_uri' => $authorization->getEndpoint(), 'headers' => ['User-Agent' => $authorization->getUserAgent() ] ]);
        $afterpaySerializer = $serializer ? : SerializerFactory::getSerializer();

        return new ConfigurationService($afterpayClient, $authorization, $afterpaySerializer);
    }

    /**
     * @param Authorization            $authorization
     * @param Client|null              $client
     * @param SerializerInterface|null $serializer
     * @return PaymentsService
     */
    public static function payments(
        Authorization $authorization,
        Client $client = null,
        SerializerInterface $serializer = null
    ) {

        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ? : new Client([ 'base_uri' => $authorization->getEndpoint(), 'headers' => ['User-Agent' => $authorization->getUserAgent() ] ]);
        $afterpaySerializer = $serializer ? : SerializerFactory::getSerializer();

        return new PaymentsService($afterpayClient, $authorization, $afterpaySerializer);
    }

    /**
     * @param Authorization            $authorization
     * @param Client|null              $client
     * @param SerializerInterface|null $serializer
     * @return OrdersService
     */
    public static function orders(
        Authorization $authorization,
        Client $client = null,
        SerializerInterface $serializer = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ? : new Client([ 'base_uri' => $authorization->getEndpoint(), 'headers' => ['User-Agent' => $authorization->getUserAgent() ] ]);
        $afterpaySerializer = $serializer ? : SerializerFactory::getSerializer();

        return new OrdersService($afterpayClient, $authorization, $afterpaySerializer);
    }

    /**
     * @param string               $endpoint
     * @param ClientInterface|null $client
     *
     * @return Ping
     */
    public static function ping(
        $endpoint,
        ClientInterface $client = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $endpoint ]);

        return new PingService($afterpayClient);
    }
}

