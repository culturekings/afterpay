<?php

namespace spec\CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model\Money;
use CultureKings\Afterpay\Model\Payment;
use CultureKings\Afterpay\Model\PaymentsList;
use CultureKings\Afterpay\Model\Refund;
use CultureKings\Afterpay\Service\Payments;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Stream\NullStream;
use GuzzleHttp\Stream\Stream;
use JMS\Serializer\SerializerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PaymentsSpec
 * @package spec\CultureKings\Afterpay\Service
 * @mixin Payments
 */
class PaymentsSpec extends ObjectBehavior
{
    function let(Client $client, Authorization $authorization, SerializerInterface $serializer)
    {
        $this->beConstructedWith($client, $authorization, $serializer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Payments::class);
    }

    function it_can_list_payments(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/payments_list_response.json');
        $serializer->deserialize($json, PaymentsList::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('payments', Argument::any())->willReturn($response);

        $this->listPayments();
    }

    function it_can_handle_list_error(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $stream = new NullStream();
        $response = new Response('400', [], $stream);

        $exception = new ClientException('ddssda', $request, $response);

        $client->get('payments', Argument::any())->willThrow($exception);

        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringListPayments();
    }

    public function it_can_capture_a_payment(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/payments_get_response.json');

        $serializer->serialize([
            'token' => '93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3',
            'merchantReference' => '',
            'webhookEventUrl' => ''
        ], 'json')->shouldBeCalled();
        $serializer->deserialize($json, Payment::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('payments/capture', Argument::any())->willReturn($response);

        $this->capture('93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3');
    }

    function it_can_handle_capture_error(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $stream = new NullStream();
        $response = new Response('400', [], $stream);

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('payments/capture', Argument::any())->willThrow($exception);

        $serializer->serialize([
            'token' => '93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3',
            'merchantReference' => '',
            'webhookEventUrl' => ''
        ], 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringCapture('93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3');
    }

    function it_can_get_a_payment_by_id(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/payments_get_response.json');

        $serializer->deserialize($json, Payment::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('payments/23841566', Argument::any())->willReturn($response);

        $this->get('23841566');
    }

    function it_can_handle_an_error_from_get_payment_by_id(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $stream = new NullStream();
        $response = new Response('400', [], $stream);

        $exception = new ClientException('ddssda', $request, $response);

        $client->get('payments/23841566', Argument::any())->willThrow($exception);

        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringGet('23841566');
    }

    function it_can_get_a_payment_by_token(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/payments_get_response.json');

        $serializer->deserialize($json, Payment::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('payments/token:93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3', Argument::any())->willReturn($response);

        $this->getByToken('93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3');
    }

    function it_can_handle_an_error_from_get_payment_by_token(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $stream = new NullStream();
        $response = new Response('400', [], $stream);

        $exception = new ClientException('ddssda', $request, $response);

        $client->get('payments/token:93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3', Argument::any())->willThrow($exception);

        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringGetByToken('93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3');
    }

    public function it_can_authorise_a_payment(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/payments_get_response.json');

        $serializer->serialize([
            'token' => '93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3',
            'merchantReference' => '',
            'webhookEventUrl' => ''
        ], 'json')->shouldBeCalled();
        $serializer->deserialize($json, Payment::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('payments', Argument::any())->willReturn($response);

        $this->authorise('93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3');
    }

    function it_can_handle_authorise_error(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $stream = new NullStream();
        $response = new Response('400', [], $stream);

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('payments', Argument::any())->willThrow($exception);

        $serializer->serialize([
            'token' => '93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3',
            'merchantReference' => '',
            'webhookEventUrl' => ''
        ], 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringAuthorise('93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3');
    }

    public function it_can_void_a_payment(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/payments_get_response.json');

        $serializer->deserialize($json, Payment::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('payments/23841566/void', Argument::any())->willReturn($response);

        $this->void('23841566');
    }

    function it_can_handle_void_error(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $stream = new NullStream();
        $response = new Response('400', [], $stream);

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('payments/23841566/void', Argument::any())->willThrow($exception);

        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringVoid('23841566');
    }

    function it_can_refund_a_payment(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/payments_refund_response.json');
        $refundAmount = new Money(50.00, 'AUD');

        $serializer->serialize([
            'amount' => $refundAmount,
            'merchantReference' => 'my_reference',
            'requestId' => 'my_request_id',
        ], 'json')->shouldBeCalled();
        $serializer->deserialize($json, Refund::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('payments/23841566/refund', Argument::any())->willReturn($response);

        $this->refund('23841566', $refundAmount, 'my_reference', 'my_request_id');
    }

    function it_can_handle_refund_error(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $refundAmount = new Money(50.00, 'AUD');

        $request = new Request('get', 'test');
        $stream = new NullStream();
        $response = new Response('400', [], $stream);

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('payments/23841566/refund', Argument::any())->willThrow($exception);

        $serializer->serialize(
            [
                'amount' => $refundAmount,
                'merchantReference' => 'my_reference',
                'requestId' => 'my_request_id',
            ],
            'json'
        )->shouldBeCalled();

        $serializer
            ->deserialize(Argument::any(), ErrorResponse::class, 'json')
            ->shouldBeCalled()
            ->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringRefund('23841566', $refundAmount, 'my_reference', 'my_request_id');
    }
}
