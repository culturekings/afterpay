<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\Consumer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ConsumerSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin \CultureKings\Afterpay\Model\Consumer
 */
class ConsumerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Consumer::class);
    }

    function its_phone_number_is_mutable()
    {
        $this->getPhoneNumber()->shouldReturn(null);
        $this->setPhoneNumber('0422042042')->shouldReturn($this);
        $this->getPhoneNumber()->shouldReturn('0422042042');
    }

    function its_given_names_is_mutable()
    {
        $this->getGivenNames()->shouldReturn(null);
        $this->setGivenNames('Joe')->shouldReturn($this);
        $this->getGivenNames()->shouldReturn('Joe');
    }

    function its_surname_is_mutable()
    {
        $this->getSurname()->shouldReturn(null);
        $this->setSurname('Consumer')->shouldReturn($this);
        $this->getSurname()->shouldReturn('Consumer');
    }

    function its_email_is_mutable()
    {
        $this->getEmail()->shouldReturn(null);
        $this->setEmail('test@afterpay.com.au')->shouldReturn($this);
        $this->getEmail()->shouldReturn('test@afterpay.com.au');
    }
}
