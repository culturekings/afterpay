<?php

namespace spec\CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Model\Configuration as ConfigurationModel;
use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Service\Configuration;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Stream\Stream;
use JMS\Serializer\SerializerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ConfigurationSpec
 * @package spec\CultureKings\Afterpay\Service
 * @mixin Configuration
 */
class ConfigurationSpec extends ObjectBehavior
{
    function let(Client $client, Authorization $auth, SerializerInterface $serializer)
    {
        $this->beConstructedWith($client, $auth, $serializer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Configuration::class);
    }

    function it_can_request_configuration_details(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__.'/../expectations/configuration_details.json');

        $serializer->deserialize($json,sprintf('array<%s>', ConfigurationModel::class), 'json')->shouldBeCalled();
        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('configuration', ['auth' => [null,null]])->willReturn($response);

        $this->get();
    }
}
