<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoneySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Money::class);
    }

    function its_amount_is_mutable()
    {
        $this->getAmount()->shouldReturn(null);
        $this->setAmount(2.43)->shouldReturn($this);
        $this->getAmount()->shouldReturn(2.43);
    }

    function its_currency_is_mutable()
    {
        $this->getCurrency()->shouldReturn(null);
        $this->setCurrency('AUD')->shouldReturn($this);
        $this->getCurrency()->shouldReturn('AUD');
    }
}
