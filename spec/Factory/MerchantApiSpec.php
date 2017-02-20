<?php

namespace spec\CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Factory\Api;
use CultureKings\Afterpay\Model\Merchant\Authorization;
use CultureKings\Afterpay\Service;
use PhpSpec\ObjectBehavior;

/**
 * Class MerchantApiSpec
 * @package spec\CultureKings\Afterpay\Factory
 */
class MerchantApiSpec extends ObjectBehavior
{
    /**
     *
     */
    public function it_can_initialise_ping() {
        $this->beConstructedThrough('ping', ['test uri']);
        $this->shouldBeAnInstanceOf(Service\Ping::class);
    }

    public function it_can_initialise_configuration(Authorization $auth)
    {
        $this->beConstructedThrough('configuration', [$auth]);
        $this->shouldBeAnInstanceOf(Service\Merchant\Configuration::class);
    }

    public function it_can_initialise_payments(Authorization $auth)
    {
        $this->beConstructedThrough('payments', [$auth]);
        $this->shouldBeAnInstanceOf(Service\Merchant\Payments::class);
    }

    public function it_can_initialise_orders(Authorization $auth)
    {
        $this->beConstructedThrough('orders', [$auth]);
        $this->shouldBeAnInstanceOf(Service\Merchant\Orders::class);
    }

    /**
     *
     */
    public function it_extends_api() {
        $this->shouldBeAnInstanceOf(Api::class);
    }
}
