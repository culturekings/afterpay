<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\Consumer;
use CultureKings\Afterpay\Model\Contact;
use CultureKings\Afterpay\Model\Discount;
use CultureKings\Afterpay\Model\Item;
use CultureKings\Afterpay\Model\Money;
use CultureKings\Afterpay\Model\OrderDetails;
use CultureKings\Afterpay\Model\ShippingCourier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OrderDetailsSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin OrderDetails
 */
class OrderDetailsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(OrderDetails::class);
    }

    function its_consumer_is_mutable(Consumer $consumer)
    {
        $this->getConsumer()->shouldReturn(null);
        $this->setConsumer($consumer)->shouldReturn($this);
        $this->getConsumer()->shouldReturn($consumer);
    }

    function its_billing_is_mutable(Contact $billing)
    {
        $this->getBilling()->shouldReturn(null);
        $this->setBilling($billing)->shouldReturn($this);
        $this->getBilling()->shouldReturn($billing);
    }

    function its_shipping_is_mutable(Contact $shipping)
    {
        $this->getShipping()->shouldReturn(null);
        $this->setShipping($shipping)->shouldReturn($this);
        $this->getShipping()->shouldReturn($shipping);
    }

    function its_courier_is_mutable(ShippingCourier $courier)
    {
        $this->getCourier()->shouldReturn(null);
        $this->setCourier($courier)->shouldReturn($this);
        $this->getCourier()->shouldReturn($courier);
    }

    function its_items_is_mutable(Item $item1, Item $item2)
    {
        $this->getItems()->shouldReturn([]);
        $this->setItems([$item1, $item2])->shouldReturn($this);
        $this->getItems()->shouldReturn([$item1, $item2]);
    }

    function its_discounts_is_mutable(Discount $discount1, Discount $discount2)
    {
        $this->getDiscounts()->shouldReturn([]);
        $this->setDiscounts([$discount1, $discount2])->shouldReturn($this);
        $this->getDiscounts()->shouldReturn([$discount1, $discount2]);
    }

    function its_total_amount_is_mutable(Money $taxAmount)
    {
        $this->getTotalAmount()->shouldReturn(null);
        $this->setTotalAmount($taxAmount)->shouldReturn($this);
        $this->getTotalAmount()->shouldReturn($taxAmount);
    }

    function its_tax_amount_is_mutable(Money $taxAmount)
    {
        $this->getTaxAmount()->shouldReturn(null);
        $this->setTaxAmount($taxAmount)->shouldReturn($this);
        $this->getTaxAmount()->shouldReturn($taxAmount);
    }

    function its_shipping_amount_is_mutable(Money $shippingAmount)
    {
        $this->getShippingAmount()->shouldReturn(null);
        $this->setShippingAmount($shippingAmount)->shouldReturn($this);
        $this->getShippingAmount()->shouldReturn($shippingAmount);
    }
}
