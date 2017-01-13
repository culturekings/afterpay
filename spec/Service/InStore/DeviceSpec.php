<?php

namespace spec\CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use JMS\Serializer\SerializerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DeviceSpec
 * @package spec\CultureKings\Afterpay\Service\InStore
 */
class DeviceSpec extends ObjectBehavior
{
    function let(Afterpay\Model\InStore\Authorization $auth, Client $client, SerializerInterface $serializer)
    {
        $this->beConstructedWith($auth, $client, $serializer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Afterpay\Service\InStore\Device::class);
    }

    function it_can_activate_a_device(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Device $device
    ) {

        $json = file_get_contents(__DIR__ . '/../../expectations/device_activation_response.json');

        $device->setName('POS1234');
        $device->setSecret('111333331001');
        $device->setAttributes(['terminal' => 'NCR', 'hardwareId' => '67878']);

        $serializer->serialize($device, 'json')->shouldBeCalled();
        $serializer->deserialize($json, sprintf('array<%s>', Afterpay\Model\InStore\Device::class), 'json')->shouldBeCalled();

        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('devices/activate', Argument::any())->willReturn($response);

        $this->activate($device);
    }
}