<?php

namespace spec\CultureKings\Afterpay\Model;

use CultureKings\Afterpay\Model\Payment;
use CultureKings\Afterpay\Model\PaymentsList;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PaymentsListSpec
 * @package spec\CultureKings\Afterpay\Model
 * @mixin PaymentsList
 */
class PaymentsListSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PaymentsList::class);
    }

    function its_total_results_are_mutable()
    {
        $this->getTotalResults()->shouldReturn(null);
        $this->setTotalResults(5)->shouldReturn($this);
        $this->getTotalResults()->shouldReturn(5);
    }

    function its_offset_is_mutable()
    {
        $this->getOffset()->shouldReturn(null);
        $this->setOffset(3)->shouldReturn($this);
        $this->getOffset()->shouldReturn(3);
    }

    function its_limit_is_mutable()
    {
        $this->getLimit()->shouldReturn(null);
        $this->setLimit(599)->shouldReturn($this);
        $this->getLimit()->shouldReturn(599);
    }

    function its_results_are_mutable(Payment $payment)
    {
        $this->getResults()->shouldReturn([]);
        $this->setResults([$payment])->shouldReturn($this);
        $this->getResults()->shouldReturn([$payment]);
    }
}
