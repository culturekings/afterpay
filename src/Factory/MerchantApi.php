<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Service\Merchant\Configuration as ConfigurationService;
use CultureKings\Afterpay\Service\Merchant\Payments as PaymentsService;
use CultureKings\Afterpay\Service\Merchant\Orders as OrdersService;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

/**
 * Class MerchantApi
 * @package CultureKings\Afterpay\Factory
 */
class MerchantApi
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

        $afterpayClient = $client ? : new Client([ 'base_url' => $authorization->getEndpoint() ]);
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

        $afterpayClient = $client ? : new Client([ 'base_url' => $authorization->getEndpoint() ]);
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

        $afterpayClient = $client ? : new Client([ 'base_url' => $authorization->getEndpoint() ]);
        $afterpaySerializer = $serializer ? : SerializerFactory::getSerializer();

        return new OrdersService($afterpayClient, $authorization, $afterpaySerializer);
    }
}
