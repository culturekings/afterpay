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
        $this->getEndpoint()->shouldReturn(null);
        $this->setEndpoint(Authorization::PRODUCTION_URI)->shouldReturn($this);
        $this->getEndpoint()->shouldReturn(Authorization::PRODUCTION_URI);
    }

    function its_device_authorization_is_mutable()
    {
        $this->getDeviceToken()->shouldReturn(null);
        $this->setDeviceToken('abc123')->shouldReturn($this);
        $this->getDeviceToken()->shouldReturn('abc123');
    }

    function its_operator_is_mutable()
    {
        $this->getOperator()->shouldReturn(null);
        $this->setOperator('Dante Hicks')->shouldReturn($this);
        $this->getOperator()->shouldReturn('Dante Hicks');
    }

    function its_user_agent_is_mutable()
    {
        $this->getUserAgent()->shouldReturn(null);
        $this->setUserAgent('POS-XYZ/10.5')->shouldReturn($this);
        $this->getUserAgent()->shouldReturn('POS-XYZ/10.5');
    }
}
