<?php

namespace spec\CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Service\Configuration;
use PhpSpec\ObjectBehavior;

/**
 * Class ApiSpec
 * @package spec\CultureKings\Afterpay\Factory
 */
class ApiSpec extends ObjectBehavior
{
    public function it_can_initialise_configuration()
    {
        $this->beConstructedThrough('configuration', []);
        $this->shouldBeAnInstanceOf(Configuration::class);
    }
}
