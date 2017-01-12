<?php

namespace spec\CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Model\Merchant\ShippingCourier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ShippingCourierSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin \CultureKings\Afterpay\Model\Merchant\ShippingCourier
 */
class ShippingCourierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ShippingCourier::class);
    }

    function its_shipped_at_is_mutable(\DateTime $shippedAt)
    {
        $this->getShippedAt()->shouldReturn(null);
        $this->setShippedAt($shippedAt)->shouldReturn($this);
        $this->getShippedAt()->shouldReturn($shippedAt);
    }

    function its_name_is_mutable()
    {
        $this->getName()->shouldReturn(null);
        $this->setName('FedEx')->shouldReturn($this);
        $this->getName()->shouldReturn('FedEx');
    }

    function its_tracking_is_mutable()
    {
        $this->getTracking()->shouldReturn(null);
        $this->setTracking('3F23D3AX')->shouldReturn($this);
        $this->getTracking()->shouldReturn('3F23D3AX');
    }

    function its_priority_is_mutable()
    {
        $this->getPriority()->shouldReturn(null);
        $this->setPriority('Overnight')->shouldReturn($this);
        $this->getPriority()->shouldReturn('Overnight');
    }
}
