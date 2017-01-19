<?php
namespace CultureKings\Afterpay\Service\Merchant;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model;
use CultureKings\Afterpay\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use JMS\Serializer\SerializerInterface;

/**
 * Class Payments
 *
 * @package CultureKings\Afterpay\Service\Merchant
 */
class Payments
{
    use Traits\ClientTrait;
    use Traits\AuthorizationTrait;
    use Traits\SerializerTrait;

    /**
     * Payments constructor.
     *
     * @param Client                       $client
     * @param Model\Merchant\Authorization $authorization
     * @param SerializerInterface          $serializer
     */
    public function __construct(
        Client $client,
        Model\Merchant\Authorization $authorization,
        SerializerInterface $serializer
    ) {
        $this->setClient($client);
        $this->setAuthorization($authorization);
        $this->setSerializer($serializer);
    }

    /**
     * @param array $filters
     * @return array|object
     *
     * I would of liked to call this list() but it's a reserved keyword in < php7
     *
     * According to Guzzle GitHub issue #1196 the build_query helper also does
     * duplicate aggregation.
     *
     * @see https://github.com/guzzle/guzzle/issues/1196
     */
    public function listPayments(array $filters = [ ])
    {
        $query = Psr7\build_query($filters);

        try {
            $result = $this->getClient()->get(
                'payments',
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                    'query' => $query,
                ]
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            Model\Merchant\PaymentsList::class,
            'json'
        );
    }

    /**
     * @param string $orderToken
     * @param string $merchantReference
     * @param string $webhookEventUrl
     *
     * @return Model\Merchant\Payment|object
     */
    public function capture($orderToken, $merchantReference = '', $webhookEventUrl = '')
    {
        $request = [
            'token' => $orderToken,
            'merchantReference' => $merchantReference,
            'webhookEventUrl' => $webhookEventUrl,
        ];

        try {
            $requestBody = $this->getSerializer()->serialize($request, 'json');
            $result = $this->getClient()->post(
                'payments/capture',
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => $requestBody,
                ]
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            Model\Merchant\Payment::class,
            'json'
        );
    }

    /**
     * @param string $id
     * @return Model\Merchant\Payment|object
     */
    public function get($id)
    {
        try {
            $result = $this->getClient()->get(
                sprintf('payments/%s', $id),
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                ]
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            Model\Merchant\Payment::class,
            'json'
        );
    }

    /**
     * @param string $token
     * @return Model\Merchant\Payment|object
     * @throws ApiException
     */
    public function getByToken($token)
    {
        try {
            $result = $this->getClient()->get(
                sprintf('payments/token:%s', $token),
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                ]
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }


        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            Model\Merchant\Payment::class,
            'json'
        );
    }

    /**
     * @param string $orderToken
     * @param string $merchantReference
     * @param string $webhookEventUrl
     * @return Model\Merchant\Payment|object
     */
    public function authorise($orderToken, $merchantReference = '', $webhookEventUrl = '')
    {
        $request = [
            'token' => $orderToken,
            'merchantReference' => $merchantReference,
            'webhookEventUrl' => $webhookEventUrl,
        ];

        try {
            $result = $this->getClient()->post(
                'payments',
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => $this->getSerializer()->serialize($request, 'json'),
                ]
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            Model\Merchant\Payment::class,
            'json'
        );
    }

    /**
     * @param string $paymentId
     * @return Model\Merchant\Payment|object
     */
    public function void($paymentId)
    {
        try {
            $result = $this->getClient()->post(
                sprintf('payments/%s/void', $paymentId),
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                ]
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            Model\Merchant\Payment::class,
            'json'
        );
    }

    /**
     * @param string      $paymentId
     * @param Model\Money $amount
     * @param string      $merchantReference
     * @param string      $requestId
     *
     * @return array|\JMS\Serializer\scalar|object
     */
    public function refund($paymentId, Model\Money $amount, $merchantReference = '', $requestId = '')
    {
        $request = [
            'amount' => $amount,
            'merchantReference' => $merchantReference,
            'requestId' => $requestId,
        ];

        try {
            $result = $this->getClient()->post(
                sprintf('payments/%s/refund', $paymentId),
                [
                    'auth' => [
                        $this->getAuthorization()->getMerchantId(),
                        $this->getAuthorization()->getSecret(),
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => $this->getSerializer()->serialize($request, 'json'),
                ]
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                )
            );
        }

        return $this->getSerializer()->deserialize(
            (string) $result->getBody(),
            Model\Merchant\Refund::class,
            'json'
        );
    }
}
