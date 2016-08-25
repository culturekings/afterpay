<?php

namespace spec\CultureKings\Afterpay\Handler;

use CultureKings\Afterpay\Handler\DateTimeHandler;
use JMS\Serializer\JsonDeserializationVisitor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DateTimeHandlerSpec
 * @package spec\CultureKings\Afterpay\Handler
 * @mixin DateTimeHandler
 */
class DateTimeHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DateTimeHandler::class);
    }

    function it_creates_a_datetime(JsonDeserializationVisitor $visitor)
    {
        $res = $this->deserializeDateTimeFromJson($visitor, '2016-01-01 00:00:00', []);
        $res->shouldBeAnInstanceOf('DateTime');
        $res->format("Y-m-d")->shouldReturn('2016-01-01');
    }

    function it_does_not_try_to_create_a_date_from_null(JsonDeserializationVisitor $visitor)
    {
        $this->deserializeDateTimeFromJson($visitor, null, [])->shouldReturn(null);
    }
}
