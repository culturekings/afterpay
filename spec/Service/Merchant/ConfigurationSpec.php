<?php

namespace spec\CultureKings\Afterpay\Service\Merchant;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model\Merchant\Authorization;
use CultureKings\Afterpay\Model\Merchant\Configuration as ConfigurationModel;
use CultureKings\Afterpay\Service\Merchant\Configuration;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
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

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator              $client
     * @param Stream|\PhpSpec\Wrapper\Collaborator              $stream
     * @param Response|\PhpSpec\Wrapper\Collaborator            $response
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator $serializer
     */
    function it_can_request_configuration_details(
        Client $client,
        Stream $stream,
        Response $response,
        SerializerInterface $serializer
    ) {
        $json = file_get_contents(__DIR__ . '/../../expectations/configuration_details.json');

        $serializer->deserialize($json,sprintf('array<%s>', ConfigurationModel::class), 'json')->shouldBeCalled();
        $stream->__toString()->willReturn($json);
        $response->getBody()->willReturn($stream);
        $client->get('configuration', ['auth' => [null,null]])->willReturn($response);

        $this->get();
    }

    /**
     * @param Client|\PhpSpec\Wrapper\Collaborator              $client
     * @param SerializerInterface|\PhpSpec\Wrapper\Collaborator $serializer
     * @param ErrorResponse|\PhpSpec\Wrapper\Collaborator       $errorResponse
     */
    function it_can_handle_an_exception(
        Client $client,
        SerializerInterface $serializer,
        ErrorResponse $errorResponse
    ) {
        $request = new Request('get', 'configuration');
        $response = new Response('401');

        $exception = new ClientException('Credentials are required to access this resource.', $request, $response);

        $client->get('configuration', Argument::any())->willThrow($exception);

        $serializer->serialize(Argument::any(), 'json')->willReturn('{}');
        $serializer->deserialize(Argument::any(), ErrorResponse::class, 'json')->shouldBeCalled()->willReturn($errorResponse);

        $this->shouldThrow(ApiException::class)->duringGet();
    }

}
