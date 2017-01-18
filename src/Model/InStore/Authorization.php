<?php
namespace CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Contacts\AuthorizationInterface;

/**
 * Class Authorization
 * @package CultureKings\Afterpay\Model\InStore
 */
class Authorization implements AuthorizationInterface
{
    const PRODUCTION_URI = 'https://posapi.secure-afterpay.com.au/v1/';
    const SANDBOX_URI = 'https://posapi-sandbox.secure-afterpay.com.au/v1/';

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $deviceToken;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * Authorization constructor.
     * @param null $endpoint
     */
    public function __construct($endpoint = null)
    {
        $this->setEndpoint($endpoint);
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * @param string $deviceToken
     *
     * @return Authorization
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     *
     * @return Authorization
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     *
     * @return Authorization
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }
}
