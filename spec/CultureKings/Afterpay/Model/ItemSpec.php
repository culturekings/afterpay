<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\Item;
use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ItemSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin Item
 */
class ItemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Item::class);
    }

    function its_name_is_mutable()
    {
        $this->getName()->shouldReturn(null);
        $this->setName('widget')->shouldReturn($this);
        $this->getName()->shouldReturn('widget');
    }

    function its_sku_is_mutable()
    {
        $this->getSKU()->shouldReturn(null);
        $this->setSKU('123412234')->shouldReturn($this);
        $this->getSKU()->shouldReturn('123412234');
    }

    function its_quantity_is_mutable()
    {
        $this->getQuantity()->shouldReturn(null);
        $this->setQuantity('1')->shouldReturn($this);
        $this->getQuantity()->shouldReturn('1');
    }

    function its_price_is_mutable(Money $price)
    {
        $this->getPrice()->shouldReturn(null);
        $this->setPrice($price)->shouldReturn($this);
        $this->getPrice()->shouldReturn($price);
    }
}
