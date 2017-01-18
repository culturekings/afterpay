<?php

namespace spec\CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PreApprovalSpec
 * @package spec\CultureKings\Afterpay\Service\InStore
 */
class PreApprovalSpec extends ObjectBehavior
{
    function let(Afterpay\Model\InStore\Authorization $auth, Client $client, SerializerInterface $serializer)
    {
        $this->beConstructedWith($auth, $client, $serializer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Afterpay\Service\InStore\PreApproval::class);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                             $client
     * @param Stream|\PhpSpec\Wrapper\Collaborator                             $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator                           $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator                $serializer
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                       $stack
     */
    function it_can_enquiry_a_preapproval(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        HandlerStack $stack
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/preapproval_enquire_response.json');

        $serializer->serialize('testcode', 'json')->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\PreApproval::class, 'json')->shouldBeCalled();

        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('preapprovals/enquire', Argument::any())->willReturn($response);

        $this->enquiry('testcode', $stack);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                             $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator                $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator       $errorResponse
     */
    function it_can_handle_preapproval_enquiry_error(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('preapprovals/enquire', Argument::any())->willThrow($exception);

        $serializer->serialize('testcode', 'json')->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringEnquiry('testcode');
    }
}
