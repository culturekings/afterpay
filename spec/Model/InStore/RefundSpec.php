<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\InStore\Refund;
use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RefundSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 * @mixin Refund
 */
class RefundSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Refund::class);
    }

    function its_refund_id_is_mutable()
    {
        $this->getRefundId()->shouldReturn(null);
        $this->setRefundId(122)->shouldReturn($this);
        $this->getRefundId()->shouldReturn(122);
    }

    function its_request_id_is_mutable()
    {
        $this->getRequestId()->shouldReturn(null);
        $this->setRequestId('7c4bdcd7-09b2-4a2d-a7cb-5017b621d6f7')->shouldReturn($this);
        $this->getRequestId()->shouldReturn('7c4bdcd7-09b2-4a2d-a7cb-5017b621d6f7');
    }

    /**
     * @param \DateTime|\PhpSpec\Wrapper\Collaborator $requestedAt
     */
    function its_requested_at_is_mutable(\DateTime $requestedAt)
    {
        $this->getRequestedAt()->shouldReturn(null);
        $this->setRequestedAt($requestedAt)->shouldReturn($this);
        $this->getRequestedAt()->shouldReturn($requestedAt);
    }

    /**
     * @param \DateTime|\PhpSpec\Wrapper\Collaborator $refundedAt
     */
    function its_refunded_at_is_mutable(\DateTime $refundedAt)
    {
        $this->getRefundedAt()->shouldReturn(null);
        $this->setRefundedAt($refundedAt)->shouldReturn($this);
        $this->getRefundedAt()->shouldReturn($refundedAt);
    }

    function its_merchant_reference_is_mutable()
    {
        $this->getMerchantReference()->shouldReturn(null);
        $this->setMerchantReference('123987')->shouldReturn($this);
        $this->getMerchantReference()->shouldReturn('123987');
    }

    function its_order_id_is_mutable()
    {
        $this->getOrderId()->shouldReturn(null);
        $this->setOrderId('100015')->shouldReturn($this);
        $this->getOrderId()->shouldReturn('100015');
    }

    function its_order_merchant_reference_is_mutable()
    {
        $this->getOrderMerchantReference()->shouldReturn(null);
        $this->setOrderMerchantReference('100012')->shouldReturn($this);
        $this->getOrderMerchantReference()->shouldReturn('100012');
    }

    /**
     * @param Money|\PhpSpec\Wrapper\Collaborator $amount
     */
    function its_amount_is_mutable(Money $amount)
    {
        $this->getAmount()->shouldReturn(null);
        $this->setAmount($amount)->shouldReturn($this);
        $this->getAmount()->shouldReturn($amount);
    }
}
