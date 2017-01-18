<?php

namespace spec\CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\InStore\Authorization;
use CultureKings\Afterpay\Service;
use PhpSpec\ObjectBehavior;

/**
 * Class InStoreApiSpec
 * @package spec\CultureKings\Afterpay\Factory
 */
class InStoreApiSpec extends ObjectBehavior
{
    /**
     * @param Authorization|\PhpSpec\Wrapper\Collaborator $auth
     */
    public function it_can_initialise_device(Authorization $auth)
    {
        $this->beConstructedThrough('device', [$auth]);
        $this->shouldBeAnInstanceOf(Service\InStore\Device::class);
    }

    /**
     * @param Authorization|\PhpSpec\Wrapper\Collaborator $auth
     */
    public function it_can_initialise_preapproval(Authorization $auth)
    {
        $this->beConstructedThrough('preapproval', [$auth]);
        //$this->shouldBeAnInstanceOf(Service\InStore\Device::class);
    }

    /**
     * @param Authorization|\PhpSpec\Wrapper\Collaborator $auth
     */
    public function it_can_initialise_order(Authorization $auth)
    {
        $this->beConstructedThrough('order', [$auth]);
        //$this->shouldBeAnInstanceOf(Service\InStore\Device::class);
    }
}
