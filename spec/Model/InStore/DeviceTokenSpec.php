<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\InStore\DeviceToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DeviceTokenSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 *
 * @mixin DeviceToken
 */
class DeviceTokenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DeviceToken::class);
    }

    function its_token_is_mutable()
    {
        $this->getToken()->shouldReturn(null);
        $this->setToken('thisisatoken')->shouldReturn($this);
        $this->getToken()->shouldReturn('thisisatoken');
    }

    function its_expires_in_is_mutable()
    {
        $this->getExpiresIn()->shouldReturn(null);
        $this->setExpiresIn(14400)->shouldReturn($this);
        $this->getExpiresIn()->shouldReturn(14400);
    }
}
