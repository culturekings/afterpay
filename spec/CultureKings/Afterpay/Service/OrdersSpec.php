<?php

namespace spec\CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Model\OrderDetails;
use CultureKings\Afterpay\Model\OrderToken;
use CultureKings\Afterpay\Service\Orders;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
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
        $json = '
        {  
     "token": "q54l9qd907m6iqqqlcrm5tpbjjsnfo47vsm59gqrfnd2rqefk9hu",
     "expires": "2016-05-10T13:14:01Z",
     "totalAmount": {  
        "amount": "10.00",
        "currency": "AUD"
     },
     "consumer": {  
        "phoneNumber": "0422042042",
        "givenNames": "Joe",
        "surname": "Consumer",
        "email": "test@afterpay.com.au"
     },
    "billing": {  
        "name": "Joe Consumer",
        "line1": "Unit 1 16 Floor",
        "line2": "380 LaTrobe Street",
        "suburb": "Melbourne",
        "state": "VIC",
        "postcode": "3000",
        "countryCode": "AU",
        "phoneNumber": "0400892011"
    },
    "shipping": {  
        "name": "Joe Consumer",
        "line1": "Unit 1 16 Floor",
        "line2": "380 LaTrobe Street",
        "suburb": "Melbourne",
        "state": "VIC",
        "postcode": "3000",
        "countryCode": "AU",
        "phoneNumber": "0400892011"
    },
    "items":[  
         {
             "name": "widget",
             "sku": "123412234",
             "quantity": 1,
             "price": {
                 "amount": "10.00",
                 "currency": "AUD"
             }
         }
     ],
     "discounts": [
      {
         "displayName": "10% Off Coupon",
         "amount": {
             "amount": "1.00",
             "currency": "AUD"
         }
      }
    ],
     "merchant": {
        "redirectConfirmUrl": "https://www.merchant.com/confirm",
        "redirectCancelUrl": "https://www.merchant.com/cancel"
     },
     "merchantReference": "merchantOrder-1234",
     "taxAmount": {  
         "amount": "10.00",
         "currency": "AUD"
     },
     "shippingAmount": {  
          "amount": "10.00",
          "currency": "AUD"
     }
}';
        $serializer->deserialize($json, OrderDetails::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('orders/abc123', ['auth' => [null,null]])->willReturn($response);

        $this->get('abc123');
    }

    function it_can_create_an_order(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        OrderDetails $orderDetails
    ) {
        $json = '{ "token": "q54l9qd907m6iqqqlcrm5tpbjjsnfo47vsm59gqrfnd2rqefk9hu", "expires": "2016-05-10T13:14:01Z" }';

        $serializer->serialize($orderDetails, OrderDetails::class, 'json')->shouldBeCalled();
        $serializer->deserialize($json, OrderToken::class, 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('orders', ['auth' => [null,null]])->willReturn($response);

        $this->create($orderDetails);
    }
}
