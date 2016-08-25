<?php

namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Handler\DateTimeHandler;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;

/**
 * Class SerializerFactory
 * @package CultureKings\Afterpay\Factory
 */
class SerializerFactory
{
    /**
     * @return \JMS\Serializer\Serializer
     */
    public static function getSerializer()
    {
        return SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $registry) {
                $registry->registerSubscribingHandler(new DateTimeHandler());
            })
            ->addMetadataDir(__DIR__.'/../Serializer')
            ->build();
    }
}
