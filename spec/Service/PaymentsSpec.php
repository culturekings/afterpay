<?php

namespace spec\CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model\Payment;
use CultureKings\Afterpay\Model\PaymentsList;
use CultureKings\Afterpay\Service\Payments;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
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
        $json = '
        {
  "totalResults": 1,
  "offset": 0,
  "limit": 20,
  "results": [
    {
      "id": "23841566",
      "token": "93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3",
      "status": "APPROVED",
      "created": "2015-03-19T20:34:55.000Z",
      "totalAmount": {
        "amount": "131.95",
        "currency": "AUD"
      },
      "merchantReference": "8302333571",
      "events": [
        {
          "created": "2016-06-21T10:00:11Z",
          "id": "2136442160",
          "type":"AUTHORISE"
        },
        {
          "created": "2016-06-22T12:00:01Z",
          "id": "6558959651",
          "type":"CAPTURE"
        }
      ],
      "refunds": [
        {
          "id": "67890123",
          "refundedAt": "2015-07-10T15:01:14.123Z",
          "merchantReference": "refundId-1234",
          "amount": {
            "amount": "10.00",
            "currency": "AUD"
          }
        }
      ],
      "orderDetails": {
        "consumer": {
          "phoneNumber": "61423081055",
          "givenNames": "Joseph",
          "surname": "Refoy"
        },
        "billing": {
          "name": "Joseph Refoy",
          "line1": "U1613 8 Church St",
          "suburb": "Fortitude Valley",
          "state": "QLD",
          "postcode": "4006"
        },
        "shipping": {
          "name": "Joseph Refoy",
          "line1": "U1613 8 Church St",
          "suburb": "Fortitude Valley",
          "state": "QLD",
          "postcode": "4006"
        },
        "courier": {},
        "items": [],
        "discounts": [],
        "shippingAmount": {
          "amount": "0.00",
          "currency": "AUD"
        }
      }
    }
  ]
}';
        $serializer->deserialize($json, PaymentsList::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('payments', Argument::any())->willReturn($response);

        $this->listPayments();

    }

    public function it_can_capture_a_payment(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = '
        {
          "id": "23841566",
          "token": "93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3",
          "status": "APPROVED",
          "created": "2015-03-19T20:34:55.000Z",
          "totalAmount": {
            "amount": "131.95",
            "currency": "AUD"
          },
          "merchantReference": "8302333571",
          "events": [
            {
              "created": "2016-06-21T10:00:11Z",
              "id": "2136442160",
              "type":"AUTHORISE"
            },
            {
              "created": "2016-06-22T12:00:01Z",
              "id": "6558959651",
              "type":"CAPTURE"
            }
          ],
          "refunds": [],
          "orderDetails": {
            "consumer": {
              "phoneNumber": "6121231421",
              "givenNames": "Jacob",
              "surname": "Smith"
            },
            "billing": {
              "name": "Jacob Smith",
              "line1": "65 Church St",
              "suburb": "Southport",
              "state": "QLD",
              "postcode": "4212"
            },
            "shipping": {
              "name": "Jacob Smith",
              "line1": "65 Church St",
              "suburb": "Southport",
              "state": "QLD",
              "postcode": "4212"
            },
            "courier": {},
            "items": [],
            "discounts": [],
            "shippingAmount": {
              "amount": "0.00",
              "currency": "AUD"
            }
          }
        }';

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
        $json = '
        {
          "id": "23841566",
          "token": "93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3",
          "status": "APPROVED",
          "created": "2015-03-19T20:34:55.000Z",
          "totalAmount": {
            "amount": "131.95",
            "currency": "AUD"
          },
          "merchantReference": "8302333571",
          "events": [
            {
              "created": "2016-06-21T10:00:11Z",
              "id": "2136442160",
              "type":"AUTHORISE"
            },
            {
              "created": "2016-06-22T12:00:01Z",
              "id": "6558959651",
              "type":"CAPTURE"
            }
          ],
          "refunds": [],
          "orderDetails": {
            "consumer": {
              "phoneNumber": "6121231421",
              "givenNames": "Jacob",
              "surname": "Smith"
            },
            "billing": {
              "name": "Jacob Smith",
              "line1": "65 Church St",
              "suburb": "Southport",
              "state": "QLD",
              "postcode": "4212"
            },
            "shipping": {
              "name": "Jacob Smith",
              "line1": "65 Church St",
              "suburb": "Southport",
              "state": "QLD",
              "postcode": "4212"
            },
            "courier": {},
            "items": [],
            "discounts": [],
            "shippingAmount": {
              "amount": "0.00",
              "currency": "AUD"
            }
          }
        }';

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
        $json = '
        {
          "id": "23841566",
          "token": "93jq77q54bi4a3sptj99ar1pshs1i20tqu9ufnjo6bdk296m1di3",
          "status": "APPROVED",
          "created": "2015-03-19T20:34:55.000Z",
          "totalAmount": {
            "amount": "131.95",
            "currency": "AUD"
          },
          "merchantReference": "8302333571",
          "events": [
            {
              "created": "2016-06-21T10:00:11Z",
              "id": "2136442160",
              "type":"AUTHORISE"
            },
            {
              "created": "2016-06-22T12:00:01Z",
              "id": "6558959651",
              "type":"CAPTURE"
            }
          ],
          "refunds": [],
          "orderDetails": {
            "consumer": {
              "phoneNumber": "6121231421",
              "givenNames": "Jacob",
              "surname": "Smith"
            },
            "billing": {
              "name": "Jacob Smith",
              "line1": "65 Church St",
              "suburb": "Southport",
              "state": "QLD",
              "postcode": "4212"
            },
            "shipping": {
              "name": "Jacob Smith",
              "line1": "65 Church St",
              "suburb": "Southport",
              "state": "QLD",
              "postcode": "4212"
            },
            "courier": {},
            "items": [],
            "discounts": [],
            "shippingAmount": {
              "amount": "0.00",
              "currency": "AUD"
            }
          }
        }';

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
}
