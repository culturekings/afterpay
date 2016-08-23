<?php

namespace spec\CultureKings\Afterpay\Exception;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\ErrorResponse;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ApiExceptionSpec
 * @package spec\CultureKings\Afterpay\Exception
 * @mixin ApiException
 */
class ApiExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ApiException::class);
    }

    function let(ErrorResponse $errorResponse)
    {
        $this->beConstructedWith($errorResponse);
    }

    function it_contains_an_error_response()
    {
        $this->getErrorResponse()->shouldBeAnInstanceOf(ErrorResponse::class);
    }
}
