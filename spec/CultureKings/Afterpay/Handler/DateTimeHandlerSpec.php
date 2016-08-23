<?php

namespace spec\CultureKings\Afterpay\Handler;

use CultureKings\Afterpay\Handler\DateTimeHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateTimeHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DateTimeHandler::class);
    }
}
