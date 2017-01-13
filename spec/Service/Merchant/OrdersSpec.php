<?php

namespace spec\CultureKings\Afterpay\Service\Merchant;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\Merchant\Authorization;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model\Merchant\OrderDetails;
use CultureKings\Afterpay\Model\Merchant\OrderToken;
use CultureKings\Afterpay\Service\Merchant\Orders;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;


use JMS\Serializer\SerializerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OrdersSpec
 * @package spec\CultureKings\Afterpay\Service
 * @mixin Orders
 */
class OrdersSpec extends ObjectBehavior
{
    function let(Client $client, Authorization $authorization, SerializerInterface $serializer)
    {
        $this->beConstructedWith($client, $authorization, $serializer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Orders::class);
    }

    function it_can_fetch_an_order(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/order_get_response.json');
        $serializer->deserialize($json, OrderDetails::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('orders/abc123', Argument::any())->willReturn($response);

        $this->get('abc123');
    }

    function it_can_handle_when_afterpay_throws_error_on_get(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->get('orders/abc123', Argument::any())->willThrow($exception);

        $serializer->serialize(Argument::any(), 'json')->willReturn('{}');
        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringGet('abc123');
    }

    function it_can_create_an_order(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        OrderDetails $orderDetails
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/order_create_response.json');

        $serializer->serialize($orderDetails, 'json')->shouldBeCalled();
        $serializer->deserialize($json, OrderToken::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('orders', Argument::any())->willReturn($response);

        $this->create($orderDetails);
    }

    function it_can_handle_when_afterpay_throws_error_on_create(
        Client $client,
        OrderDetails $orderDetails,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('orders', Argument::any())->willThrow($exception);

        $serializer->serialize(Argument::any(), 'json')->willReturn('{}');
        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringCreate($orderDetails);
    }
}
