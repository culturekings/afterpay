<?php
namespace CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Contacts\AuthorizationInterface;

/**
 * Class Authorization
 *
 * @package CultureKings\Afterpay
 */
class Authorization implements AuthorizationInterface
{
    const PRODUCTION_URI = 'https://api.secure-afterpay.com.au/v1/';
    const PRODUCTION_BASE_URI = 'https://api.secure-afterpay.com.au';
    const SANDBOX_URI = 'https://api-sandbox.secure-afterpay.com.au/v1/';
    const SANDBOX_BASE_URL = 'https://api-sandbox.secure-afterpay.com.au';

    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var string
     */
    protected $merchantId;
    /**
     * @var string
     */
    protected $secret;
    /**
     * @var string
     */
    protected $user_agent;

    /**
     * Authorization constructor.
     * @param string      $endpoint
     * @param string|null $merchantId
     * @param string|null $secret
     */
    public function __construct($endpoint, $merchantId = null, $secret = null)
    {
        $this->setEndpoint($endpoint);
        $this->setMerchantId($merchantId);
        $this->setSecret($secret);
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
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }


    /**
     * @param string $user_agent
     * @return $this
     */
    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;

        return $this;
    }
    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }
}

