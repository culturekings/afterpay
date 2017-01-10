<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Service\Merchant\Configuration as ConfigurationService;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

/**
 * Class InStoreApi
 * @package CultureKings\Afterpay\Factory
 */
class InStoreApi
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
}
