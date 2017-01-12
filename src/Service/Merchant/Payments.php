<?php
namespace CultureKings\Afterpay\Service\Merchant;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model\Money;
use CultureKings\Afterpay\Model\Payment;
use CultureKings\Afterpay\Model\PaymentsList;
use CultureKings\Afterpay\Model\Refund;
use CultureKings\Afterpay\Traits\AuthorizationTrait;
use CultureKings\Afterpay\Traits\ClientTrait;
use CultureKings\Afterpay\Traits\SerializerTrait;
use GuzzleHttp\Client;
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
    use ClientTrait;
    use AuthorizationTrait;
    use SerializerTrait;

    /**
     * Payments constructor.
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
            $result->getBody()->getContents(),
            PaymentsList::class,
            'json'
        );
    }

    /**
     * @param string $orderToken
     * @param string $merchantReference
     * @param string $webhookEventUrl
     *
     * @return Payment|object
     */
    public function capture($orderToken, $merchantReference = '', $webhookEventUrl = '')
    {
        $request = [
            'token' => $orderToken,
            'merchantReference' => $merchantReference,
            'webhookEventUrl' => $webhookEventUrl,
        ];

        try {
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
                    'body' => $this->getSerializer()->serialize($request, 'json'),
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
            $result->getBody()->getContents(),
            Payment::class,
            'json'
        );
    }

    /**
     * @param string $id
     * @return Payment|object
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
            $result->getBody()->getContents(),
            Payment::class,
            'json'
        );
    }

    /**
     * @param string $token
     * @return Payment|object
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
            $result->getBody()->getContents(),
            Payment::class,
            'json'
        );
    }

    /**
     * @param string $orderToken
     * @param string $merchantReference
     * @param string $webhookEventUrl
     * @return Payment|object
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
            $result->getBody()->getContents(),
            Payment::class,
            'json'
        );
    }

    /**
     * @param string $paymentId
     * @return Payment|object
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
            $result->getBody()->getContents(),
            Payment::class,
            'json'
        );
    }

    /**
     * @param string $paymentId
     * @param Money  $amount
     * @param string $merchantReference
     * @param string $requestId
     * @return array|\JMS\Serializer\scalar|object
     */
    public function refund($paymentId, Money $amount, $merchantReference = '', $requestId = '')
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
            $result->getBody()->getContents(),
            Refund::class,
            'json'
        );
    }
}
