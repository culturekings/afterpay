<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\OrderToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OrderTokenSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin OrderToken
 */
class OrderTokenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(OrderToken::class);
    }

    function its_token_is_mutable()
    {
        $this->getToken()->shouldReturn(null);
        $this->setToken('q54l9qd907m6iqqqlcrm5tpbjjsnfo47vsm59gqrfnd2rqefk9hu')->shouldReturn($this);
        $this->getToken()->shouldReturn('q54l9qd907m6iqqqlcrm5tpbjjsnfo47vsm59gqrfnd2rqefk9hu');
    }

    function its_billing_is_mutable(\DateTime $expires)
    {
        $this->getExpires()->shouldReturn(null);
        $this->setExpires($expires)->shouldReturn($this);
        $this->getExpires()->shouldReturn($expires);
    }
}
