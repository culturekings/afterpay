<?php

namespace spec\CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Service\Merchant\Configuration;
use CultureKings\Afterpay\Service\Merchant\Orders;
use CultureKings\Afterpay\Service\Merchant\Payments;
use PhpSpec\ObjectBehavior;

/**
 * Class ApiSpec
 * @package spec\CultureKings\Afterpay\Factory
 */
class ApiSpec extends ObjectBehavior
{
    public function it_can_initialise_configuration(Authorization $auth)
    {
        $this->beConstructedThrough('configuration', [$auth]);
        $this->shouldBeAnInstanceOf(Configuration::class);
    }

    public function it_can_initialise_payments(Authorization $auth)
    {
        $this->beConstructedThrough('payments', [$auth]);
        $this->shouldBeAnInstanceOf(Payments::class);
    }

    public function it_can_initialise_orders(Authorization $auth)
    {
        $this->beConstructedThrough('orders', [$auth]);
        $this->shouldBeAnInstanceOf(Orders::class);
    }
}
