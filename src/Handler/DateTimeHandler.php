<?php

namespace CultureKings\Afterpay\Handler;

use Carbon\Carbon;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;

/**
 * Class DateTimeHandler
 * @package CultureKings\Afterpay\Handler
 */
class DateTimeHandler implements SubscribingHandlerInterface
{
    /**
     * @return array
     */
    public static function getSubscribingMethods()
    {
        return [
            array(
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'DateTime',
                'method' => 'deserializeDateTimeFromJson',
            ),
        ];
    }

    /**
     * @param JsonDeserializationVisitor $visitor
     * @param string                     $data
     * @param array                      $type
     * @return null|Carbon
     */
    public function deserializeDateTimeFromJson(JsonDeserializationVisitor $visitor, $data, array $type)
    {
        if (null === $data) {
            return null;
        }

        return Carbon::parse($data);
    }
}
