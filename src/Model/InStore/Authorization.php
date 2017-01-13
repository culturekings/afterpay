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
}
