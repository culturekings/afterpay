<?php

namespace spec\CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use JMS\Serializer\SerializationContext;
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

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param Stream|\PhpSpec\Wrapper\Collaborator                        $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                      $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\InStore\Device|\PhpSpec\Wrapper\Collaborator $device
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                  $stack
     */
    function it_can_activate_a_device(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Device $device,
        HandlerStack $stack
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/device_activation_response.json');

        $device->setName('POS1234');
        $device->setSecret('111333331001');
        $device->setAttributes(['terminal' => 'NCR', 'hardwareId' => '67878']);

        $serializer->serialize($device, 'json', SerializationContext::create()->setGroups(['activateDevice']))->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\Device::class, 'json')->shouldBeCalled();

        $stream->__toString()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('devices/activate', Argument::any())->willReturn($response);

        $this->activate($device, $stack);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator  $errorResponse
     * @param Afterpay\Model\InStore\Device|\PhpSpec\Wrapper\Collaborator $device
     */
    function it_can_handle_device_activation_error(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse,
        Afterpay\Model\InStore\Device $device
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('devices/activate', Argument::any())->willThrow($exception);

        $serializer->serialize($device, 'json', SerializationContext::create()->setGroups(['activateDevice']))->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringActivate($device);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param Stream|\PhpSpec\Wrapper\Collaborator                        $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                      $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\InStore\Device|\PhpSpec\Wrapper\Collaborator $device
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                  $stack
     */
    function it_can_generate_a_device_token(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Device $device,
        HandlerStack $stack
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/generate_device_token_response.json');

        $device->getDeviceId()->willReturn(1234);

        $serializer->serialize($device, 'json', SerializationContext::create()->setGroups(['createToken']))->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\DeviceToken::class, 'json')->shouldBeCalled();

        $stream->__toString()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('devices/1234/token', Argument::any())->willReturn($response);

        $this->createToken($device, $stack);
    }

    function it_can_handle_device_token_error(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse,
        Afterpay\Model\InStore\Device $device
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $device->getDeviceId()->willReturn(1234);

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('devices/1234/token', Argument::any())->willThrow($exception);

        $serializer->serialize($device, 'json', SerializationContext::create()->setGroups(['createToken']))->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringCreateToken($device);
    }
}
