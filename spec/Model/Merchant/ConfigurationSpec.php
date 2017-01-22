<?php

namespace spec\CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Model\Merchant\Configuration;
use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ConfigurationSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin Configuration
 */
class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Configuration::class);
    }

    function its_type_is_mutable()
    {
        $this->getType()->shouldReturn(null);
        $this->setType('PAY_AFTER_DELIVERY')->shouldReturn($this);
        $this->getType()->shouldReturn('PAY_AFTER_DELIVERY');
    }

    function its_description_is_mutable()
    {
        $this->getDescription()->shouldReturn(null);
        $this->setDescription('Try before you pay')->shouldReturn($this);
        $this->getDescription()->shouldReturn('Try before you pay');
    }

    function its_minimum_amount_is_mutable(Money $minimumAmount)
    {
        $this->getMinimumAmount()->shouldReturn(null);
        $this->setMinimumAmount($minimumAmount)->shouldReturn($this);
        $this->getMinimumAmount()->shouldReturn($minimumAmount);
    }

    function its_maximum_amount_is_mutable(Money $maximumAmount)
    {
        $this->getMaximumAmount()->shouldReturn(null);
        $this->setMaximumAmount($maximumAmount)->shouldReturn($this);
        $this->getMaximumAmount()->shouldReturn($maximumAmount);
    }
}
