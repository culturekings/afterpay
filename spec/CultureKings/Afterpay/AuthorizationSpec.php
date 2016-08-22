<?php

namespace spec\CultureKings\Afterpay;

use CultureKings\Afterpay\Authorization;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AuthorizationSpec
 * @package spec\CultureKings\Afterpay
 * @mixin Authorization
 */
class AuthorizationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Authorization::class);
    }

    function its_secret_is_mutable()
    {
        $this->getSecret()->shouldReturn(null);
        $this->setSecret('mysecretkey')->shouldReturn($this);
        $this->getSecret()->shouldReturn('mysecretkey');
    }

    function its_merchant_id_is_mutable()
    {
        $this->getMerchantId()->shouldReturn(null);
        $this->setMerchantId('12345')->shouldReturn($this);
        $this->getMerchantId()->shouldReturn('12345');
    }
}
