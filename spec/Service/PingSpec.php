<?php
namespace spec\CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Service\Ping;
use GuzzleHttp\Client;
use PhpSpec\ObjectBehavior;

/**
 * Class PingSpec
 * @package spec\CultureKings\Afterpay\Service
 */
class PingSpec extends ObjectBehavior
{

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Ping::class);
    }

    function it_will_return_true_on_success(Client $client) {

        $client->get('ping')->willReturn(true);

        $this->setClient($client);

        $this->ping()->shouldReturn(true);
    }

    function it_will_return_false_on_failure(Client $client) {

        $client->get('ping')->willThrow(new \Exception('error'));

        $this->setClient($client);

        $this->ping()->shouldReturn(false);
    }
}
