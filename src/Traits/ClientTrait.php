<?php

namespace CultureKings\Afterpay\Traits;

use GuzzleHttp\ClientInterface;

/**
 * Class ClientTrait
 * @package CultureKings\Afterpay\Traits
 */
trait ClientTrait
{
    /**
     * @var
     */
    private $client;

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
}
