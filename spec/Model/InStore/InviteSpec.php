<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\InStore\Invite;
use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class InviteSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 * @mixin Invite
 */
class InviteSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Invite::class);
    }

    function its_mobile_is_mutable()
    {
        $this->getMobile()->shouldReturn(null);
        $this->setMobile('0400090000')->shouldReturn($this);
        $this->getMobile()->shouldReturn('0400090000');
    }

    /**
     * @param Money|\PhpSpec\Wrapper\Collaborator $money
     */
    function its_expected_amount_is_mutable(Money $money)
    {
        $this->getExpectedAmount()->shouldReturn(null);
        $this->setExpectedAmount($money)->shouldReturn($this);
        $this->getExpectedAmount()->shouldReturn($money);
    }
}
