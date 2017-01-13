<?php
namespace CultureKings\Afterpay\Traits;

use CultureKings\Afterpay\Contacts\AuthorizationInterface;

/**
 * Class AuthorizationTrait
 * @package CultureKings\Afterpay\Traits
 */
trait AuthorizationTrait
{
    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    /**
     * @return AuthorizationInterface
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * @param AuthorizationInterface $authorization
     */
    public function setAuthorization(AuthorizationInterface $authorization)
    {
        $this->authorization = $authorization;
    }
}
