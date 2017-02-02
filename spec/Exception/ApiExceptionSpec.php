<?php

namespace spec\CultureKings\Afterpay\Exception;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\ErrorResponse;
use Exception;
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

    function it_can_be_constructed_normally(
        ErrorResponse $errorResponse,
        Exception $e
    ) {
        $this->beConstructedWith($errorResponse, 'error message', 5, $e);
        $this->getErrorResponse()->shouldReturn($errorResponse);
        $this->getMessage()->shouldReturn('error message');
        $this->getCode()->shouldReturn(5);
        $this->getPrevious()->shouldReturn($e);
    }

    function it_can_be_constructed_minimally(
        ErrorResponse $errorResponse,
        Exception $e
    ) {
        $this->beConstructedWith($errorResponse, $e);

        $this->getErrorResponse()->shouldReturn($errorResponse);
        $this->getPrevious()->shouldReturn($e);
    }
}
