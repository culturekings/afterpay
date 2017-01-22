<?php

namespace spec\CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Contacts\AuthorizationInterface;
use CultureKings\Afterpay\Model\Merchant\Authorization;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AuthorizationSpec
 * @package spec\CultureKings\Afterpay
 * @mixin Authorization
 */
class AuthorizationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(Authorization::SANDBOX_URI);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Authorization::class);
        $this->shouldBeAnInstanceOf(AuthorizationInterface::class);
    }

    function its_endpoint_is_mutable()
    {
        $this->setEndpoint(Authorization::PRODUCTION_URI)->shouldReturn($this);
        $this->getEndpoint()->shouldReturn(Authorization::PRODUCTION_URI);
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
