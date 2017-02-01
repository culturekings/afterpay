<?php

namespace CultureKings\Afterpay\Handler;

use Carbon\Carbon;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;

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
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'DateTime',
                'method' => 'deserializeDateTimeFromJson',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'DateTime',
                'method' => 'serializeDateTimeToJson',
            ],
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

    /**
     * @param JsonSerializationVisitor $visitor
     * @param \DateTimeInterface       $data
     * @param array                    $type
     *
     * @return string
     */
    public function serializeDateTimeToJson(JsonSerializationVisitor $visitor, $data, array $type)
    {
        return $data->format($type['params'][0]);
    }
}
