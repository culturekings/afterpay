<?php
namespace CultureKings\Afterpay\Service;

use CultureKings\Afterpay\Traits\ClientTrait;
use Exception;
use GuzzleHttp\Client;

/**
 * Class Ping
 * @package CultureKings\Afterpay\Service\InStore
 */
class Ping
{
    use ClientTrait;

    /**
     * Ping constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * Attempt to access the ping endpoint and will return true on success.
     * @return bool
     */
    public function ping()
    {
        try {
            $this->getClient()->get('ping');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
