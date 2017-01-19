<?php

namespace spec\CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\SerializerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CustomerSpec
 * @package spec\CultureKings\Afterpay\Service\InStore
 */
class CustomerSpec extends ObjectBehavior
{
    function let(Afterpay\Model\InStore\Authorization $auth, Client $client, SerializerInterface $serializer)
    {
        $this->beConstructedWith($auth, $client, $serializer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Afterpay\Service\InStore\Customer::class);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param Response|\PhpSpec\Wrapper\Collaborator                      $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\InStore\Invite|\PhpSpec\Wrapper\Collaborator $invite
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                  $stack
     */
    function it_can_invite_a_customer(
        Client $client,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\Invite $invite,
        HandlerStack $stack
    ) {
        $serializer->serialize($invite, 'json')->shouldBeCalled();

        $client->post('invite', Argument::any())->willReturn($response);

        $this->invite($invite, $stack);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                        $client
     * @param Afterpay\Model\InStore\Invite|\PhpSpec\Wrapper\Collaborator $invite
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator           $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator  $errorResponse
     */
    function it_can_handle_invite_customer_error(
        Client $client,
        Afterpay\Model\InStore\Invite $invite,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('invite', Argument::any())->willThrow($exception);

        $serializer->serialize($invite, 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringInvite($invite);
    }
}
