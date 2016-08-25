<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\ErrorResponse;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ErrorResponseSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin ErrorResponse
 */
class ErrorResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ErrorResponse::class);
    }

    function its_error_code_is_mutable()
    {
        $this->getErrorCode()->shouldReturn(null);
        $this->setErrorCode('invalid_object')->shouldReturn($this);
        $this->getErrorCode()->shouldReturn('invalid_object');
    }

    function its_error_id_is_mutable()
    {
        $this->getErrorId()->shouldReturn(null);
        $this->setErrorId('a8bb3564572bef83')->shouldReturn($this);
        $this->getErrorId()->shouldReturn('a8bb3564572bef83');
    }

    function its_message_is_mutable()
    {
        $this->getMessage()->shouldReturn(null);
        $this->setMessage('[merchant Merchant Options required (was null), totalAmount Total amount is required (was null)]')->shouldReturn($this);
        $this->getMessage()->shouldReturn('[merchant Merchant Options required (was null), totalAmount Total amount is required (was null)]');
    }

    function its_http_status_code_is_mutable()
    {
        $this->getHttpStatusCode()->shouldReturn(null);
        $this->setHttpStatusCode(422)->shouldReturn($this);
        $this->getHttpStatusCode()->shouldReturn(422);
    }
}
