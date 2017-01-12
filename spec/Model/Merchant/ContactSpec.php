<?php

namespace spec\CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Model\Merchant\Contact;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ContactSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin Contact
 */
class ContactSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Contact::class);
    }

    function its_name_is_mutable()
    {
        $this->getName()->shouldReturn(null);
        $this->setName('Joe Consumer')->shouldReturn($this);
        $this->getName()->shouldReturn('Joe Consumer');
    }

    function its_line1_is_mutable()
    {
        $this->getLine1()->shouldReturn(null);
        $this->setLine1('Unit 1 16 Floor')->shouldReturn($this);
        $this->getLine1()->shouldReturn('Unit 1 16 Floor');
    }

    function its_line2_is_mutable()
    {
        $this->getLine2()->shouldReturn(null);
        $this->setLine2('300 LaTrobe Street')->shouldReturn($this);
        $this->getLine2()->shouldReturn('300 LaTrobe Street');
    }

    function its_suburb_is_mutable()
    {
        $this->getSuburb()->shouldReturn(null);
        $this->setSuburb('Melbourne')->shouldReturn($this);
        $this->getSuburb()->shouldReturn('Melbourne');
    }

    function its_state_is_mutable()
    {
        $this->getState()->shouldReturn(null);
        $this->setState('VIC')->shouldReturn($this);
        $this->getState()->shouldReturn('VIC');
    }

    function its_postcode_is_mutable()
    {
        $this->getPostcode()->shouldReturn(null);
        $this->setPostcode('3000')->shouldReturn($this);
        $this->getPostcode()->shouldReturn('3000');
    }

    function its_country_code_is_mutable()
    {
        $this->getCountryCode()->shouldReturn(null);
        $this->setCountryCode('AU')->shouldReturn($this);
        $this->getCountryCode()->shouldReturn('AU');
    }

    function its_phone_number_is_mutable()
    {
        $this->getPhoneNumber()->shouldReturn(null);
        $this->setPhoneNumber('0400892011')->shouldReturn($this);
        $this->getPhoneNumber()->shouldReturn('0400892011');
    }
}
