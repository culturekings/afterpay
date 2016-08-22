<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Service\Configuration;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;

class Api
{
    public static function configuration(
        Client $client = null,
        Serializer $serializer = null,
        LoggerInterface $logger = null
    ){
        AnnotationRegistry::registerLoader('class_exists');

        if ($client === null) {
            $client = new Client();
        }

        if ($serializer === null) {
            $serializer = SerializerBuilder::create()
                ->addMetadataDir(__DIR__.'/../Serializer')
                ->build();
        }

        $api = new Configuration($client, $serializer, $logger);
        return $api;
    }

    public static function payments()
    {

    }


}
