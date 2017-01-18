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
     * @param Afterpay\Model\InStore\PreApproval|\PhpSpec\Wrapper\Collaborator $preApproval
     * @param HandlerStack|\PhpSpec\Wrapper\Collaborator                       $stack
     */
    function it_can_enquiry_a_preapproval(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer,
        Afterpay\Model\InStore\PreApproval $preApproval,
        HandlerStack $stack
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/device_activation_response.json');

        $serializer->serialize($preApproval, 'json', SerializationContext::create()->setGroups(['preApproval']))->shouldBeCalled();
        $serializer->deserialize($json, Afterpay\Model\InStore\Device::class, 'json')->shouldBeCalled();

        $stream->getContents()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->post('preapprovals/enquire', Argument::any())->willReturn($response);

        $this->enquiry($preApproval, $stack);
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator                             $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator                $serializer
     * @param Afterpay\Model\ErrorResponse|\PhpSpec\Wrapper\Collaborator       $errorResponse
     * @param Afterpay\Model\InStore\PreApproval|\PhpSpec\Wrapper\Collaborator $preApproval
     */
    function it_can_handle_preapproval_enquiry_error(
        Client $client,
        SerializerInterface $serializer,
        Afterpay\Model\ErrorResponse $errorResponse,
        Afterpay\Model\InStore\PreApproval $preApproval
    ) {
        $request = new Request('get', 'test');
        $response = new Response('400');

        $exception = new ClientException('ddssda', $request, $response);

        $client->post('preapprovals/enquire', Argument::any())->willThrow($exception);

        $serializer->serialize($preApproval, 'json', SerializationContext::create()->setGroups(['preApproval']))->shouldBeCalled();
        $serializer->deserialize(Argument::any(), Afterpay\Model\ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(Afterpay\Exception\ApiException::class)->duringEnquiry($preApproval);
    }
}
