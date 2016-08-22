<?php

namespace spec\CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Authorization;
use CultureKings\Afterpay\Service\Configuration;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use JMS\Serializer\SerializerBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ConfigurationSpec
 * @package spec\CultureKings\Afterpay\Service
 * @mixin Configuration
 */
class ConfigurationSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $serializer = SerializerBuilder::create()
            ->addMetadataDir(__DIR__.'/../../../../src/CultureKings/Afterpay/Serializer')
            ->build();
        $this->beConstructedWith($client, $serializer, true);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Configuration::class);
    }

    function it_can_request_configuration_details(
        Client $client,
        Authorization $auth,
        ResponseInterface $response,
        Stream $stream
    ) {
        $auth->getSecret()->willReturn('sosecret');
        $auth->getMerchantId()->willReturn('abc123');

        $client->get('/v1/configuration', [
            'auth' => ['abc123', 'sosecret'],
        ])->willReturn($response);

        $stream->getContents()->willReturn('[
            { 
                "type": "PAY_BY_INSTALLMENT",
                "description": "Pay over time",
                "minimumAmount": {
                     "amount": "0.00",
                     "currency": "AUD"
                 },
                "maximumAmount": {
                    "amount": "500.00",
                    "currency": "AUD"
                }
            }
        ]');

        $response->getBody()->willReturn($stream);

        $this->setClient($client);

        $res = $this->get($auth);
        $res->shouldHaveCount(1);
        $res[0]->shouldBeAnInstanceOf(\CultureKings\Afterpay\Model\Configuration::class);
        $res[0]->getType()->shouldReturn('PAY_BY_INSTALLMENT');
        $res[0]->getDescription()->shouldReturn('Pay over time');
    }
}
