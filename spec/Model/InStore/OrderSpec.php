<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\InStore\Order;
use CultureKings\Afterpay\Model\Item;
use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OrderSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 * @mixin Order
 */
class OrderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Order::class);
    }

    function its_order_id_is_mutable()
    {
        $this->getOrderId()->shouldReturn(null);
        $this->setOrderId(100012)->shouldReturn($this);
        $this->getOrderId()->shouldReturn(100012);
    }

    /**
     * @param \DateTime|\PhpSpec\Wrapper\Collaborator $dateTime
     */
    function its_ordered_at_is_mutable(\DateTime $dateTime)
    {
        $this->getOrderedAt()->shouldReturn(null);
        $this->setOrderedAt($dateTime)->shouldReturn($this);
        $this->getOrderedAt()->shouldReturn($dateTime);
    }

    function its_request_id_is_mutable()
    {
        $this->getRequestId()->shouldReturn(null);
        $this->setRequestId('61cdad2d-8e10-42ec-a97b-8712dd7a8ca9')->shouldReturn($this);
        $this->getRequestId()->shouldReturn('61cdad2d-8e10-42ec-a97b-8712dd7a8ca9');
    }

    /**
     * @param \DateTime|\PhpSpec\Wrapper\Collaborator $dateTime
     */
    function its_requested_at_is_mutable(\DateTime $dateTime)
    {
        $this->getRequestedAt()->shouldReturn(null);
        $this->setRequestedAt($dateTime)->shouldReturn($this);
        $this->getRequestedAt()->shouldReturn($dateTime);
    }

    function its_merchant_reference_is_mutable()
    {
        $this->getMerchantReference()->shouldReturn(null);
        $this->setMerchantReference('123987')->shouldReturn($this);
        $this->getMerchantReference()->shouldReturn('123987');
    }

    function its_pre_approval_code_is_mutable()
    {
        $this->getPreApprovalCode()->shouldReturn(null);
        $this->setPreApprovalCode('12FA1G3C2E9D')->shouldReturn($this);
        $this->getPreApprovalCode()->shouldReturn('12FA1G3C2E9D');
    }

    /**
     * @param Money|\PhpSpec\Wrapper\Collaborator $money
     */
    function its_amount_is_mutable(Money $money)
    {
        $this->getAmount()->shouldReturn(null);
        $this->setAmount($money)->shouldReturn($this);
        $this->getAmount()->shouldReturn($money);
    }

    /**
     * @param Item|\PhpSpec\Wrapper\Collaborator $item
     * @param Item|\PhpSpec\Wrapper\Collaborator $item2
     */
    function its_items_are_mutable(Item $item, Item $item2)
    {
        $this->getOrderItems()->shouldReturn([]);
        $this->setOrderItems([$item])->shouldReturn($this);
        $this->addOrderItem($item2)->shouldReturn($this);
        $this->getOrderItems()->shouldReturn([$item, $item2]);
    }
}
