<?php

namespace spec\CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\InStore\Device;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DeviceSpec
 * @package spec\CultureKings\Afterpay\Model\InStore
 *
 * @mixin Device
 */
class DeviceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Device::class);
    }

    function its_secret_is_mutable()
    {
        $this->getSecret()->shouldReturn(null);
        $this->setSecret('muchsecretkey')->shouldReturn($this);
        $this->getSecret()->shouldReturn('muchsecretkey');
    }

    function its_name_is_mutable()
    {
        $this->getName()->shouldReturn(null);
        $this->setName('Device-1234')->shouldReturn($this);
        $this->getName()->shouldReturn('Device-1234');
    }

    function its_attributes_are_mutable()
    {
        $this->getAttributes()->shouldReturn([]);
        $this->setAttributes(['terminal' => 'NCR', 'hardwareId' => '678678'])->shouldReturn($this);
        $this->getAttributes()->shouldReturn(['terminal' => 'NCR', 'hardwareId' => '678678']);
    }
}
