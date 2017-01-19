<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\InStore\OrderReversal;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OrderReversalSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 * @mixin OrderReversal
 */
class OrderReversalSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OrderReversal::class);
    }

    function its_reverse_id_is_mutable()
    {
        $this->getReverseId()->shouldReturn(null);
        $this->setReverseId('100020')->shouldReturn($this);
        $this->getReverseId()->shouldReturn('100020');
    }

    function its_reversed_at_is_mutable(\DateTime $reversedAt)
    {
        $this->getReversedAt()->shouldReturn(null);
        $this->setReversedAt($reversedAt)->shouldReturn($this);
        $this->getReversedAt()->shouldReturn($reversedAt);
    }

    function its_request_at_is_mutable(\DateTime $requestedAt)
    {
        $this->getRequestedAt()->shouldReturn(null);
        $this->setRequestedAt($requestedAt)->shouldReturn($this);
        $this->getRequestedAt()->shouldReturn($requestedAt);
    }

    function its_reversing_request_id_is_mutable()
    {
        $this->getReversingRequestId()->shouldReturn(null);
        $this->setReversingRequestId('61cdad2d-8e10-42ec-a97b-8712dd7a8ca9')->shouldReturn($this);
        $this->getReversingRequestId()->shouldReturn('61cdad2d-8e10-42ec-a97b-8712dd7a8ca9');
    }
}
