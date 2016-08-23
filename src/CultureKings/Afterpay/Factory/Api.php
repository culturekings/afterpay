<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Service\Configuration as ConfigurationService;
use CultureKings\Afterpay\Service\Payments as PaymentsService;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

/**
 * Class Api
 * @package CultureKings\Afterpay\Factory
 */
class Api
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

        if ($client === null) {
            $client = new Client(['base_url' => $authorization->getEndpoint()]);
        }

        if ($serializer === null) {
            $serializer = SerializerFactory::getSerializer();
        }

        return new ConfigurationService($client, $authorization, $serializer);
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

        if ($client === null) {
            $client = new Client(['base_url' => $authorization->getEndpoint()]);
        }

        if ($serializer === null) {
            $serializer = SerializerFactory::getSerializer();
        }

        return new PaymentsService($client, $authorization, $serializer);
    }
}
