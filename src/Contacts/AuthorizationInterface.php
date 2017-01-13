<?php
namespace CultureKings\Afterpay\Contacts;

/**
 * Interface AuthorizationInterface
 * @package CultureKings\Afterpay\Contacts
 */
interface AuthorizationInterface
{
    /**
     * @param string $endpoint
     *
     * @return $this
     */
    public function setEndpoint($endpoint);

    /**
     * @return string|null
     */
    public function getEndpoint();
}
