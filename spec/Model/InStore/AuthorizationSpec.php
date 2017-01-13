<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Contacts\AuthorizationInterface;
use CultureKings\Afterpay\Model\InStore\Authorization;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AuthorizationSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 * @mixin Authorization
 */
class AuthorizationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Authorization::class);
        $this->shouldBeAnInstanceOf(AuthorizationInterface::class);
    }

    function its_endpoint_is_mutable()
    {
        $this->setEndpoint(Authorization::PRODUCTION_URI)->shouldReturn($this);
        $this->getEndpoint()->shouldReturn(Authorization::PRODUCTION_URI);
    }
}
