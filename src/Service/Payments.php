<?php
namespace CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model\Payment;
use CultureKings\Afterpay\Model\PaymentsList;
use CultureKings\Afterpay\Traits\AuthorizationTrait;
use CultureKings\Afterpay\Traits\ClientTrait;
use CultureKings\Afterpay\Traits\SerializerTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Query;
use JMS\Serializer\SerializerInterface;

/**
 * Class Payments
 *
 * @package CultureKings\Afterpay\Service
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
     */
    public function listPayments(array $filters = [])
    {
        $query = new Query($filters);
        $query->setAggregator($query::duplicateAggregator());

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
        $result = $this->getClient()->get(
            sprintf('payments/%s', $id),
            [
                'auth' => [
                    $this->getAuthorization()->getMerchantId(),
                    $this->getAuthorization()->getSecret(),
                ],
            ]
        );

        return $this->getSerializer()->deserialize(
            $result->getBody()->getContents(),
            Payment::class,
            'json'
        );
    }

    /**
     * @param string $token
     * @return Payment|object
     */
    public function getByToken($token)
    {
        $result = $this->getClient()->get(
            sprintf('payments/token:%s', $token),
            [
                'auth' => [
                    $this->getAuthorization()->getMerchantId(),
                    $this->getAuthorization()->getSecret(),
                ],
            ]
        );

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
        ];
        if ($merchantReference) {
            $request['merchantReference'] = $merchantReference;
        }
        if ($webhookEventUrl) {
            $request['webhookEventUrl'] = $webhookEventUrl;
        }

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
}
