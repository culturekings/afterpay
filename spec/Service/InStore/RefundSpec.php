<?php

namespace spec\CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RefundSpec
 * @package spec\CultureKings\Afterpay\Service\InStore
 */
class RefundSpec extends ObjectBehavior
{
    function let(Afterpay\Model\InStore\Authorization $auth, Client $client, SerializerInterface $serializer)
    {
        $this->beConstructedWith($auth, $client, $serializer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Afterpay\Service\InStore\Refund::class);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param Stream|\PhpSpec\Wrapper\Collaborator                        $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                      $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator $refund
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                  $stack
     */
    function it_can_refund_an_order(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Refund $refund,
        HandlerStack $stack
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/refund_order_response.json');

        $serializer->serialize($refund, 'json')->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\Refund::class, 'json')->shouldBeCalled();

        $stream->__toString()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('refunds', Argument::any())->willReturn($response);

        $this->create($refund, $stack);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator  $errorResponse
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator $refund
     */
    function it_can_handle_create_refund_error(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse,
        Afterpay\Model\InStore\Refund $refund
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('refunds', Argument::any())->willThrow($exception);

        $serializer->serialize($refund, 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringCreate($refund);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                          $client
     * @param Stream|\PhpSpec\Wrapper\Collaborator                          $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                        $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator             $serializer
     * @param Afterpay\Model\InStore\Reversal|\PhpSpec\Wrapper\Collaborator $refundReversal
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                    $stack
     */
    function it_can_reverse_a_refund(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Reversal $refundReversal,
        HandlerStack $stack
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/refund_order_response.json');

        $serializer->serialize($refundReversal, 'json')->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\Reversal::class, 'json')->shouldBeCalled();

        $stream->__toString()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('refunds/reverse', Argument::any())->willReturn($response);

        $this->reverse($refundReversal, $stack);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                          $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator             $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator    $errorResponse
     * @param Afterpay\Model\InStore\Reversal|\PhpSpec\Wrapper\Collaborator $refund
     */
    function it_can_handle_refund_reversal_error(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse,
        Afterpay\Model\InStore\Reversal $refund
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('refunds/reverse', Argument::any())->willThrow($exception);

        $serializer->serialize($refund, 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringReverse($refund);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                          $client
     * @param Stream|\PhpSpec\Wrapper\Collaborator                          $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                        $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator             $serializer
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator   $refund
     * @param Afterpay\Model\InStore\Reversal|\PhpSpec\Wrapper\Collaborator $reversal
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                    $stack
     */
    function it_can_create_a_refund_with_createOrReverse(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Refund $refund,
        Afterpay\Model\InStore\Reversal $reversal,
        HandlerStack $stack
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/refund_order_response.json');

        $serializer->serialize($refund, 'json')->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\Refund::class, 'json')->shouldBeCalled()->willReturn($refund);

        $stream->__toString()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('refunds', Argument::any())->willReturn($response);

        $res = $this->createOrReverse($refund, $reversal, $stack);
        $res->shouldBeAnInstanceOf(Afterpay\Model\InStore\Refund::class);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator  $errorResponse
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator $refund
     */
    function it_will_throw_an_exception_when_a_conflict_is_returned_with_createOrReverse(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse,
        Afterpay\Model\InStore\Refund $refund
    ) {
        $errorResponse->getErrorCode()->shouldBeCalled()->willReturn(Afterpay\Service\InStore\Refund::ERROR_CONFLICT);
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('refunds', Argument::any())->willThrow($exception);

        $serializer->serialize($refund, 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringCreateOrReverse($refund);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                          $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator             $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator    $errorResponse
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator   $refund
     * @param Stream|\PhpSpec\Wrapper\Collaborator                          $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                        $reversalResponse
     */
    function it_will_attempt_a_reversal_when_a_validation_error_is_returned_with_createOrReverse(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse,
        Afterpay\Model\InStore\Refund $refund,
        Stream $stream,
        Response $reversalResponse
    ) {
        $refundReversal = new Afterpay\Model\InStore\Reversal();
        $errorResponse->getErrorCode()->shouldBeCalled()->willReturn(Afterpay\Service\InStore\Refund::ERROR_INVALID_AMOUNT);
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('refunds', Argument::any())->willThrow($exception);

        $json = file_get_contents(__DIR__ . '/../../expectations/refund_order_response.json');

        $serializer->serialize($refundReversal, 'json')->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\Reversal::class, 'json')->shouldBeCalled()->willReturn($refundReversal);

        $stream->__toString()->willReturn($json);
        $reversalResponse->getBody()->willReturn($stream);
        $client->post('refunds/reverse', Argument::any())->shouldBeCalled()->willReturn($reversalResponse);

        $serializer->serialize($refund, 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $res = $this->createOrReverse($refund, $refundReversal);

        $res->shouldBeAnInstanceOf(Afterpay\Model\InStore\Reversal::class);
        $res->getErrorReason()->shouldBeAnInstanceOf(Afterpay\Model\ErrorResponse::class);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator $refund
     * @param Stream|\PhpSpec\Wrapper\Collaborator                        $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                      $reversalResponse
     */
    function it_will_attempt_a_reversal_when_a_server_error_is_returned_with_createOrReverse(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Refund $refund,
        Stream $stream,
        Response $reversalResponse
    ) {
        $refundReversal = new Afterpay\Model\InStore\Reversal();
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new RequestException('ddssda', $request, $response);

        $client->post('refunds', Argument::any())->willThrow($exception);

        $json = file_get_contents(__DIR__ . '/../../expectations/order_reverse_response.json');

        $serializer->serialize($refundReversal, 'json')->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\Reversal::class, 'json')->shouldBeCalled()->willReturn($refundReversal);

        $stream->__toString()->willReturn($json);
        $reversalResponse->getBody()->willReturn($stream);
        $client->post('refunds/reverse', Argument::any())->shouldBeCalled()->willReturn($reversalResponse);

        $serializer->serialize($refund, 'json')->shouldBeCalled();

        $res = $this->createOrReverse($refund, $refundReversal);

        $res->shouldBeAnInstanceOf(Afterpay\Model\InStore\Reversal::class);
        $res->getErrorReason()->shouldBeAnInstanceOf(Afterpay\Model\ErrorResponse::class);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator $refund
     */
    function it_will_throw_a_refund_exception_when_a_reversal_fails(
        Client $client,
        Afterpay\Model\InStore\Refund $refund
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $orderException = new RequestException('ddssda', $request, $response);

        $errorCode = new Afterpay\Model\ErrorResponse();
        $errorCode->setErrorCode(Afterpay\Service\InStore\Refund::ERROR_MSG_PRECONDITION_FAILED);

        $reversalException = new Afterpay\Exception\ApiException($errorCode);

        $client->post('refunds', Argument::any())->willThrow($orderException);
        $client->post('refunds/reverse', Argument::any())->willThrow($reversalException);

        $this->shouldThrow($orderException)->duringCreateOrReverse($refund);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param Afterpay\Model\InStore\Refund|\PhpSpec\Wrapper\Collaborator $refund
     */
    function it_will_throw_a_refund_reversal_exception_when_a_reversal_fails(
        Client $client,
        Afterpay\Model\InStore\Refund $refund
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $orderException = new RequestException('ddssda', $request, $response);

        $errorCode = new Afterpay\Model\ErrorResponse();
        $errorCode->setErrorCode('not_precondition_failed');

        $reversalException = new Afterpay\Exception\ApiException($errorCode);

        $client->post('refunds', Argument::any())->willThrow($orderException);
        $client->post('refunds/reverse', Argument::any())->willThrow($reversalException);

        $this->shouldThrow($reversalException)->duringCreateOrReverse($refund);
    }
}
