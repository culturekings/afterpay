<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\InStore\PreApproval;
use CultureKings\Afterpay\Model\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PreApprovalSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 *
 * @mixin PreApproval
 */
class PreApprovalSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PreApproval::class);
    }

    function its_preapproval_code_is_mutable()
    {
        $this->getPreApprovalCode()->shouldReturn(null);
        $this->setPreApprovalCode('C10WFS8DV3')->shouldReturn($this);
        $this->getPreApprovalCode()->shouldReturn('C10WFS8DV3');
    }

    /**
     * @param Money|\PhpSpec\Wrapper\Collaborator $money
     */
    function its_minimum_is_mutable(Money $money)
    {
        $this->getMinimum()->shouldReturn(null);
        $this->setMinimum($money)->shouldReturn($this);
        $this->getMinimum()->shouldReturn($money);
    }

    /**
     * @param Money|\PhpSpec\Wrapper\Collaborator $money
     */
    function its_amount_is_mutable(Money $money)
    {
        $this->getAmount()->shouldReturn(null);
        $this->setAmount($money)->shouldReturn($this);
        $this->getAmount()->shouldReturn($money);
    }

    function its_expires_at_is_mutable(\DateTime $expiresAt)
    {
        $this->getExpiresAt()->shouldReturn(null);
        $this->setExpiresAt($expiresAt)->shouldReturn($this);
        $this->getExpiresAt()->shouldReturn($expiresAt);
    }
}
