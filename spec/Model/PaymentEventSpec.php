<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\PaymentEvent;
use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PaymentEventSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin PaymentEvent
 */
class PaymentEventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PaymentEvent::class);
    }

    function its_created_is_mutable(DateTime $created)
    {
        $this->getCreated()->shouldReturn(null);
        $this->setCreated($created)->shouldReturn($this);
        $this->getCreated()->shouldReturn($created);
    }

    function its_id_is_mutable()
    {
        $this->getId()->shouldReturn(null);
        $this->setId('vHxUGE5FO9bBesLnv4eQ')->shouldReturn($this);
        $this->getId()->shouldReturn('vHxUGE5FO9bBesLnv4eQ');
    }

    function its_type_is_mutable()
    {
        $this->getType()->shouldReturn(null);
        $this->setType('AUTHORISE')->shouldReturn($this);
        $this->getType()->shouldReturn('AUTHORISE');
    }
}
