<?php

namespace spec\CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Service\Configuration;
use CultureKings\Afterpay\Service\Payments;
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
}
