<?php

namespace spec\CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Model\Money;
use CultureKings\Afterpay\Model\Merchant\OrderDetails;
use CultureKings\Afterpay\Model\Merchant\Payment;
use CultureKings\Afterpay\Model\Merchant\PaymentEvent;
use CultureKings\Afterpay\Model\Merchant\Refund;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PaymentSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin Payment
 */
class PaymentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Payment::class);
    }

    function its_id_is_mutable()
    {
        $this->getId()->shouldReturn(null);
        $this->setId('12345678')->shouldReturn($this);
        $this->getId()->shouldReturn('12345678');
    }

    function its_token_is_mutable()
    {
        $this->getToken()->shouldReturn(null);
        $this->setToken('q54l9qd907m6iqqqlcrm5tpbjjsnfo47vsm59gqrfnd2rqefk9hu')->shouldReturn($this);
        $this->getToken()->shouldReturn('q54l9qd907m6iqqqlcrm5tpbjjsnfo47vsm59gqrfnd2rqefk9hu');
    }

    function its_status_is_mutable()
    {
        $this->getStatus()->shouldReturn(null);
        $this->setStatus('APPROVED')->shouldReturn($this);
        $this->getStatus()->shouldReturn('APPROVED');
    }

    function its_created_is_mutable(\DateTime $date)
    {
        $this->getCreated()->shouldReturn(null);
        $this->setCreated($date)->shouldReturn($this);
        $this->getCreated()->shouldReturn($date);
    }

    function its_total_amount_is_mutable(Money $money)
    {
        $this->getTotalAmount()->shouldReturn(null);
        $this->setTotalAmount($money)->shouldReturn($this);
        $this->getTotalAmount()->shouldReturn($money);
    }

    function its_merchant_reference_is_mutable()
    {
        $this->getMerchantReference()->shouldReturn(null);
        $this->setMerchantReference('merchantOrder-1234')->shouldReturn($this);
        $this->getMerchantReference()->shouldReturn('merchantOrder-1234');
    }

    function its_events_are_mutable(PaymentEvent $event)
    {
        $this->getEvents()->shouldReturn([]);
        $this->setEvents([$event])->shouldReturn($this);
        $this->getEvents()->shouldReturn([$event]);
    }

    function its_refunds_are_mutable(Refund $refund)
    {
        $this->getRefunds()->shouldReturn([]);
        $this->setRefunds([$refund])->shouldReturn($this);
        $this->getRefunds()->shouldReturn([$refund]);
    }

    function its_order_details_is_mutable(OrderDetails $orderDetails)
    {
        $this->getOrderDetails()->shouldReturn(null);
        $this->setOrderDetails($orderDetails)->shouldReturn($this);
        $this->getOrderDetails()->shouldReturn($orderDetails);
    }
}
