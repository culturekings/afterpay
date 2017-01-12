<?php

namespace spec\CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Model\Merchant\Discount;
use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DiscountSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin Discount
 */
class DiscountSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Discount::class);
    }

    function its_display_name_is_mutable()
    {
        $this->getDisplayName()->shouldReturn(null);
        $this->setDisplayName('Returning Customer Coupon')->shouldReturn($this);
        $this->getDisplayName()->shouldReturn('Returning Customer Coupon');
    }

    function its_amount_is_mutable(Money $money)
    {
        $this->getAmount()->shouldReturn(null);
        $this->setAmount($money)->shouldReturn($this);
        $this->getAmount()->shouldReturn($money);
    }
}
