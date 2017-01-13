<?php
namespace CultureKings\Afterpay\Service\Merchant;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model\Merchant\Authorization;
use CultureKings\Afterpay\Model\Merchant\OrderDetails;
use CultureKings\Afterpay\Model\Merchant\OrderToken;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use JMS\Serializer\SerializerInterface;

/**
 * Class Orders
 *
 * @package CultureKings\Afterpay\Service\Merchant
 */
class Orders
{
    use Traits\ClientTrait;
    use Traits\AuthorizationTrait;
    use Traits\SerializerTrait;

    /**
     * Orders constructor.
     *
     * @param Client              $client
     * @param Authorization       $authorization
     * @param SerializerInterface $serializer
     */
    public function __construct(
        Client $client,
        Authorization $authorization,
        SerializerInterface $serializer
    ) {
        $this->setClient($client);
        $this->setAuthorization($authorization);
        $this->setSerializer($serializer);
    }

    /**
     * @param OrderDetails $order
     * @return OrderToken|object
     */
    public function create(OrderDetails $order)
    {
        try {
            $result = $this->getClient()->post(
                'orders',
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => $this->getSerializer()->serialize($order, 'json'),
                ]
            );
        } catch (ClientException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    $e->getResponse()->getBody()->getContents(),
                    ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            OrderToken::class,
            'json'
        );
    }

    /**
     * @param string $token
     * @return OrderDetails|object
     */
    public function get($token)
    {
        try {
            $result = $this->getClient()->get(
                sprintf('orders/%s', $token),
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                ]
            );
        } catch (ClientException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    $e->getResponse()->getBody()->getContents(),
                    ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            OrderDetails::class,
            'json'
        );
    }
}
