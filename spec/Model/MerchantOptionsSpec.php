<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\MerchantOptions;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MerchantOptionsSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin MerchantOptions
 */
class MerchantOptionsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MerchantOptions::class);
    }

    function its_redirect_cancel_url_is_mutable()
    {
        $this->getRedirectCancelUrl()->shouldReturn(null);
        $this->setRedirectCancelUrl('https://www.merchant.com/cancel')->shouldReturn($this);
        $this->getRedirectCancelUrl()->shouldReturn('https://www.merchant.com/cancel');
    }

    function its_redirect_confirm_url_is_mutable()
    {
        $this->getRedirectConfirmUrl()->shouldReturn(null);
        $this->setRedirectConfirmUrl('https://www.merchant.com/confirm')->shouldReturn($this);
        $this->getRedirectConfirmUrl()->shouldReturn('https://www.merchant.com/confirm');
    }
}
