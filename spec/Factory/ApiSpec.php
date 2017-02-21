<?php

namespace spec\CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Service;
use PhpSpec\ObjectBehavior;

/**
 * Class ApiSpec
 * @package spec\CultureKings\Afterpay\Factory
 */
class ApiSpec extends ObjectBehavior
{
    /**
     *
     */
    public function it_can_initialise_ping() {
        $this->beConstructedThrough('ping', ['test uri']);
        $this->shouldBeAnInstanceOf(Service\Ping::class);
    }
}
