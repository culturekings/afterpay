<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\Money;
use CultureKings\Afterpay\Model\Refund;
use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RefundSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin Refund
 */
class RefundSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Refund::class);
    }

    function its_id_is_mutable()
    {
        $this->getRefundId()->shouldReturn(null);
        $this->setRefundId('67890123')->shouldReturn($this);
        $this->getRefundId()->shouldReturn('67890123');
    }

    function its_refunded_at_is_mutable(DateTime $refundedAt)
    {
        $this->getRefundedAt()->shouldReturn(null);
        $this->setRefundedAt($refundedAt)->shouldReturn($this);
        $this->getRefundedAt()->shouldReturn($refundedAt);
    }

    function its_merchant_reference_is_mutable()
    {
        $this->getMerchantReference()->shouldReturn(null);
        $this->setMerchantReference('merchantRefundId-1234')->shouldReturn($this);
        $this->getMerchantReference()->shouldReturn('merchantRefundId-1234');
    }

    function its_amount_is_mutable(Money $amount)
    {
        $this->getAmount()->shouldReturn(null);
        $this->setAmount($amount)->shouldReturn($this);
        $this->getAmount()->shouldReturn($amount);
    }
}
