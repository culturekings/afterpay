<?php

namespace spec\CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Authorization;
use CultureKings\Afterpay\Service\Configuration;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ConfigurationSpec
 * @package spec\CultureKings\Afterpay\Service
 * @mixin Configuration
 */
class ConfigurationSpec extends ObjectBehavior
{
    function let()
    {
        $client = new Client(['base_uri' => 'https://api-sandbox.secure-afterpay.com.au']);
        $serializer = SerializerBuilder::create()
            ->addMetadataDir(__DIR__.'/../../../../src/CultureKings/Afterpay/Serializer')
            ->build();
        $this->beConstructedWith($client, $serializer, true);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Configuration::class);
    }

    function it_can_request_configuration_details()
    {
        $auth = new Authorization();

        $res = $this->get($auth);
    }
}
